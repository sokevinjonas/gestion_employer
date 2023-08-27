<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable',
        ];
    }
    public function message()
    {
        return [
        'nom.required' => 'Le champ Nom est obligatoire.',
        'prenom.required' => 'Le champ Prénom est obligatoire.',
        'email.required' => 'Le champ Adresse e-mail est obligatoire.',
        'email.email' => 'Veuillez entrer une adresse e-mail valide.',
        'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
        // 'password.required' => 'Le champ Mot de passe est obligatoire.',
        // 'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
        ];
    }
}
