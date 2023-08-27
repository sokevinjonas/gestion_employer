<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'departement_id' => 'required',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|unique:employers,email',
            'contact' => 'required|integer|min:8|unique:employers,contact',
            'montant_journalier' =>'required|integer|min:5',
        ];
    }
    public function message(){
        return [
            'nom.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prenom est obligatoire',

            'email.required' => 'Le email est obligatoire',
            'email.unique' => 'Le email est existe deja',

            'contact.required' => 'Le contact est obligatoire',
            'contact.integer' => 'Le contact est de minimum 8 chiffres',
            'contact.unique' => 'Ce contact existe deja',

            'montant_journalier.required' => 'Le montant_journalier est obligatoire',
            'montant_journalier.integer' => 'Le minimum du montant_journalier est de 5 chiffes',
        ];
    }
}
