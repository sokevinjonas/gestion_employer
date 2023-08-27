<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConfigRequest extends FormRequest
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
            'type' => 'required|unique:configurations,type',
            'value' => 'required'
        ];
    }
    public function message(){
        return [
            'type.required' => "Le type de configuration est requis",
            'type.required' => "Cette configuration existes deja",
            'value' => "La configuration est requis"
        ];
    }
}
