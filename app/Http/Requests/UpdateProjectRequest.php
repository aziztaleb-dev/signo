<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'     => ['required', 'string', 'max:255'],
            'image'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'clients'   => ['nullable', 'array'],
            'clients.*' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'    => 'Le titre est obligatoire.',
            'title.string'      => 'Le titre doit être une chaîne de caractères.',
            'title.max'         => 'Le titre ne doit pas dépasser 255 caractères.',
            'image.image'       => 'Le fichier doit être une image.',
            'image.mimes'       => "L'image doit être au format jpg, jpeg, png ou webp.",
            'image.max'         => "L'image ne doit pas dépasser 4 Mo.",
            'clients.array'     => 'La liste des références clients est invalide.',
            'clients.*.string'  => 'Chaque référence client doit être un texte valide.',
            'clients.*.max'     => 'Chaque référence client ne doit pas dépasser 255 caractères.',
        ];
    }
}
