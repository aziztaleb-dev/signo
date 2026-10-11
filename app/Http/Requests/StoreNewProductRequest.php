<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'images'      => ['required', 'array', 'min:1'],
            'images.*'    => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'description' => ['required', 'string'],
            'pdf'         => ['file', 'mimes:pdf', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Le nom est obligatoire.',
            'name.string'          => 'Le nom doit être une chaîne de caractères.',
            'name.max'             => 'Le nom ne doit pas dépasser 255 caractères.',
            'images.required'      => 'Veuillez ajouter au moins une image.',
            'images.array'         => "L'album d'images est invalide.",
            'images.min'           => 'Veuillez ajouter au moins une image.',
            'images.*.image'       => 'Chaque fichier doit être une image.',
            'images.*.mimes'       => 'Les images doivent être au format jpg, jpeg, png ou webp.',
            'images.*.max'         => 'Chaque image ne doit pas dépasser 4 Mo.',
            'description.required' => 'La description est obligatoire.',
            'description.string'   => 'La description doit être un texte valide.',
            'pdf.file'             => 'La fiche produit doit être un fichier.',
            'pdf.mimes'            => 'La fiche produit doit être au format PDF.',
            'pdf.max'              => 'La fiche produit ne doit pas dépasser 10 Mo.',
        ];
    }
}
