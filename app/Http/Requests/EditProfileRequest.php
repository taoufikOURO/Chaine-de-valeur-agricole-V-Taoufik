<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            "username" => "required|string|min:5|max:255",
            "first_name" => "required|string|min:3|max:255",
            "last_name" => "required|string|min:3|max:255",
        ];
    }
    public function messages(): array
    {
        return [
            "username.required" => "Le nom d'utilisateur est un champ obigatoire",
            "username.min" => "Le nom d'utilisateur doit avoir au moins 5 caractères",
            "username.max" => "Le nom d'utilisateur ne doit pas dépasser 255 caractères",

            "first_name.required" => "Le prénom est un champ obigatoire",
            "first_name.min" => "Le prénom doit avoir au moins 3 caractères",
            "first_name.max" => "Le prénom ne doit pas dépasser 255 caractères",

            "last_name.required" => "Le nom est un champ obigatoire",
            "last_name.min" => "Le nom doit avoir au moins 3 caractères",
            "last_name.max" => "Le nom ne doit pas dépasser 255 caractères",

        ];
    }
}
