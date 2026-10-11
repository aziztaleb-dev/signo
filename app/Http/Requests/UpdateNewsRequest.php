<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'description' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Le nom est obligatoire.',
            'name.string'          => 'Le nom doit être une chaîne de caractères.',
            'name.max'             => 'Le nom ne doit pas dépasser 255 caractères.',
            'image.image'          => 'Le fichier doit être une image.',
            'image.mimes'          => "L'image doit être au format jpg, jpeg, png ou webp.",
            'image.max'            => "L'image ne doit pas dépasser 4 Mo.",
            'description.required' => 'La description est obligatoire.',
            'description.string'   => 'La description doit être un texte valide.',
        ];
    }
}
