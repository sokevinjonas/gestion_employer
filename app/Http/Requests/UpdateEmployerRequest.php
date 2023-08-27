<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerRequest extends FormRequest
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
            'email' => 'required|email',
            'contact' => 'required|integer',
            'montant_journalier' =>'required|integer',
        ];
    }
    public function message(){
        return [
            'nom.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prenom est obligatoire',

            'email.required' => 'Le email est obligatoire',
            'email.email' => 'Le format de l\'email est mauvaise',
            'contact.required' => 'Le contact est obligatoire',
            'contact.integer' => 'Le numero de telephone doit contenir que des chiffres',

            'montant_journalier.required' => 'Le montant_journalier est obligatoire',
            'montant_journalier.integer' => 'Le minimum du montant_journalier doit contenir que des chiffres',
        ];
    }
}
