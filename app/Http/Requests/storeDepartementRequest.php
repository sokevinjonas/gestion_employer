<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeDepartementRequest extends FormRequest
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
            'nom' => 'required|unique:departements,nom',
        ];

    }
    public function message() {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.unique' => 'Le nom de ce departement existe deja'
        ];
    }
}
