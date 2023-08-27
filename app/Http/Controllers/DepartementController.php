<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Http\Requests\storeDepartementRequest;

class DepartementController extends Controller
{
    public function index(){
        $departements = Departement::latest('created_at')->paginate(10);
        return view('Departement.index', compact('departements'));
    }

    public function create(){
        return view('Departement.create');
    }
    
    public function store(storeDepartementRequest $request){
        try {
            $query = Departement::create($request->all());
             return redirect()->route('departement.index')->with('message_success', "Département enregistré avec succès.");
        } catch (Exception $e) {
            dd($e);
        }

    }

    public function edit(Departement $departement){
        return view('Departement.edit', compact('departement'));
    }

    public function update(Departement $departement ,storeDepartementRequest $request){
        try{
            $query = $departement->update($request->all());
            return redirect()->route('departement.index')->with('message_success', "Département modifié avec succès.");
        } catch (Exception $e){
            dd($e);
        }
    }

    public function delete(Departement $departement){
        try{

            $departement->delete();
            return redirect()->route('departement.index')->with('message_delete', "Département supprimé avec succès.");
        } catch (Exception $e){
            dd($e);
        }
    }
}

