<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'work_subcategory_id' => ['required', 'integer', 'exists:work_subcategories,id'],
            'title'               => ['required', 'string', 'max:255'],
            'title_en'               => ['max:255'],
            'images'              => ['required', 'array', 'min:1'],
            'images.*'            => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'description'         => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'work_subcategory_id.required' => 'Veuillez sélectionner une sous-catégorie.',
            'work_subcategory_id.integer'  => 'La sous-catégorie sélectionnée est invalide.',
            'work_subcategory_id.exists'   => "La sous-catégorie sélectionnée n'existe pas.",
            'title.required'               => 'Le titre est obligatoire.',
            'title.string'                 => 'Le titre doit être une chaîne de caractères.',
            'title.max'                    => 'Le titre ne doit pas dépasser 255 caractères.',
            'title_en.max'                    => 'Le titre EN ne doit pas dépasser 255 caractères.',
            'images.required'              => 'Veuillez ajouter au moins une image.',
            'images.array'                 => "L'album d'images est invalide.",
            'images.min'                   => 'Veuillez ajouter au moins une image.',
            'images.*.image'               => 'Chaque fichier doit être une image.',
            'images.*.mimes'               => 'Les images doivent être au format jpg, jpeg, png ou webp.',
            'images.*.max'                 => 'Chaque image ne doit pas dépasser 4 Mo.',
            'description.required'         => 'La description est obligatoire.',
            'description.string'           => 'La description doit être un texte valide.',
        ];
    }
}
