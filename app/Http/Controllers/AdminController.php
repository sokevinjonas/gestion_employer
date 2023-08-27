<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAdminRequest;
use Illuminate\Notifications\Notification;
use App\Http\Requests\ValidateAccessRequest;
use App\Notifications\EnvoiEmailAdminStoreNotification;

class AdminController extends Controller
{
    public function create()
    {
        return view('Admin/create');
    }
    
    public function store(StoreAdminRequest $request)
{
    try {
        $password = Hash::make('1234');
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => $password
        ]);
        // Envoi du code par email pour vérification
        if ($user) {
            try {
                // Supprimer les anciens codes de réinitialisation associés à l'email
                ResetCodePassword::where('email', $user->email)->delete();
                
                // Générer un nouveau code aléatoire
                $code = rand(1000000, 9999999);
                
                // Enregistrer le nouveau code de réinitialisation
                $data = [
                    'code' => $code,
                    'email' => $user->email
                ];
                ResetCodePassword::create($data);
                // Envoyez la notification à l'e-mail saisi
                $user->notify(new EnvoiEmailAdminStoreNotification($code, $user->email));
                return redirect()->route('adminDashboard.create')->with('message_success', 'Le compte a été créé avec succès');
            } catch (\Exception $e) {
                dd($e);
                // En cas d'erreur lors de l'envoi du mail
                // throw new Exception("Une erreur est survenue lors de l'envoi du mail");
            }
        }
    } catch (Exception $e) {
        dd($e);
        // En cas d'erreur lors de l'enregistrement de l'admin
        // throw new Exception('Une erreur est survenue lors de l\'enregistrement');
    }
}

    
    // ceci est la fonction qui permet de de modifier
    public function edit(User $user)
    {
        return view('Admin/edit');
    }

    // ceci est la fonction qui permet de traiter le form  de modification 
    public function update(User $user, UpdateRequest $request)
    {
        
        try{
            //logique de modification
        } catch (\Exception $e) {
            throw new Exception('Une erreur est survenu lors de la modification');
        }
        
    }

    public function delete(User $user)
    {
        try {
            //code de logique
        } catch (\Exception $e) {
            throw Exception('Une erreur est survenu lors de la suppression');
        }
    }

    public function defineAccess($email){
        $checkuser = User::where('email', $email)->first();

        if($checkuser){
            return view('Authentifiaction.validate-account', compact('email'));
        }
        else{
            //retourner une page 404
        }
    }

    public function validateAccess(ValidateAccessRequest $request){
       $user = User::where('email', $request->email)->first();

       try {
        if($user)
        {
            $newpwd = $request->password;
            $user->password = Hash::make($newpwd);
            $user->email_verified_at = Carbon::now();
            $user->update();

            return redirect()->route('login')->with('message_success', "La verification a ete effectuer avec success, Veuillez vous connecter!");
        }
       } catch (\Exception $e) {
        dd($e);
       }

    }
}
