<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Http\Requests\StoreConfigRequest;

class ConfigurationController extends Controller
{
    public function index(){
        $lesconfiguartions = Configuration::latest()->paginate(10);
        return view('Configuration.index', compact('lesconfiguartions'));
    }
    public function create(){
        return view('Configuration.create');
    }

    public function store(StoreConfigRequest $reqest){
        try {
            Configuration::create($reqest->all());
            return redirect()->route('configurations')->with('message_success', "Votre configuration a été créée avec succès.");
        } catch (\Exception $e) {
            dd($e);
            throw new Exception("Erreur lors de l'enregistrement de la configuration.");
        }
    }

    public function delete(Configuration $lesconfig){
        try {
            $lesconfig->delete();
            return redirect()->route('configurations')->with('message_delete', "Votre configuration a été supprimée avec succès.");
        } catch (\Exception $th) {
            throw Exception("Une erreur est survenue lors de la suppression.");
        }
    }
}
