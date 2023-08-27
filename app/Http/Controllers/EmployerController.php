<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Employer;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;

class EmployerController extends Controller

{
    public function index()
    {
        $employers = Employer::with('departement')->latest('created_at')->paginate(10);
        return view('Employers.index', compact('employers'));
    }


    public function create(){
        $departements = Departement::all();
        return view('Employers.create', compact('departements'));
    }

    public function edit(Employer $employer){
        $departements = Departement::all();
        return view('Employers.edit', compact('employer','departements'));
    }

    public function store(StoreEmployerRequest $request){
       $query = Employer::create($request->all());
       if($query){
        return redirect()->route('employer.index')->with('message_success', "Employé enregistré avec succès.");
       } else {
        return redirect()->back();

       }
    }

    public function update(UpdateEmployerRequest $request, Employer $employer){
        $query = $employer->update($request->all());
        if($query){
         return redirect()->route('employer.index')->with('message_success',"Employé modifié avec succès.");
        } else {
            return redirect()->back();
        }
     }
     public function delete(Employer $employer){
        try{
            $employer->delete();
            return redirect()->route('employer.index')->with('message_delete', "Employé supprimé avec succès.");
        } catch (Exception $e){
            dd($e);
        }
    }
     
}
