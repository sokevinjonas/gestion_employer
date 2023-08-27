<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }
    public function message()
    {
        return [
            'email.required' => 'L\'email est obligatoire',
            'email.exists' => 'L\'email n\'existe pas',
            'email.email' => 'Le format de l\'email est incorrect',
            'password.required' => 'Le mot de passe est obligatoire',
        ];
    }
    
}
