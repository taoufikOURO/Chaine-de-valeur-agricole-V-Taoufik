<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "username" => "required|string|min:5|max:255|unique:users",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|max:255|confirmed",
            "first_name" => "required|string|min:3|max:255",
            "last_name" => "required|string|min:3|max:255",
            "phone_number" => "required|string|min:8|max:32|unique:users",
        ];
    }

    public function messages(): array
    {
        return [
            "username.required" => "Le nom d'utilisateur est un champ obigatoire",
            "username.min" => "Le nom d'utilisateur doit avoir au moins 5 caractères",
            "username.max" => "Le nom d'utilisateur ne doit pas dépasser 255 caractères",
            "username.unique" => "Le nom d'utilisateur est déjà utilisé",

            'email.required' => "L'adresse email est un champ obigatoire",
            'email.email' => "Veuillez rentrer une adresse email valide",
            'email.unique' => "L'adresse email est déjà utilisée",

            "first_name.required" => "Le prénom est un champ obigatoire",
            "first_name.min" => "Le prénom doit avoir au moins 3 caractères",
            "first_name.max" => "Le prénom ne doit pas dépasser 255 caractères",

            "last_name.required" => "Le nom est un champ obigatoire",
            "last_name.min" => "Le nom doit avoir au moins 3 caractères",
            "last_name.max" => "Le nom ne doit pas dépasser 255 caractères",

            "phone_number.required" => "Le numéro de téléphone est un champ obigatoire",
            "phone_number.min" => "Le numéro de téléphone doit avoir au moins 8 caractères",
            "phone_number.max" => "Le numéro de téléphone ne doit pas dépasser 32 caractères",
            "phone_number.unique" => "Le numéro de téléphone est déjà utilisé",

            "password.required" => "Le mot de passe est un champ obigatoire",
            "password.min" => "Le mot de passe doit avoir au moins 8 caractères",
            "password.max" => "Le mot de passe ne doit pas dépasser 32 caractères",
            "password.confirmed" => "Les mots de passe ne correspondent pas",
        ];
    }
}
