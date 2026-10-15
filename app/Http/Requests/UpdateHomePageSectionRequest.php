<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomePageSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],

            'paragraphs' => ['nullable', 'array'],
            'paragraphs.*' => ['nullable', 'string'],

            'quote' => ['nullable', 'string'],
            'quote_author' => ['nullable', 'string', 'max:255'],

            // Image principale
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'remove_image' => ['nullable', 'boolean'],

            // Galerie
            'gallery' => ['nullable', 'array', 'max:10'],
            'gallery.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['string'],

            // Bouton
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'Le fichier principal doit être une image valide.',
            'image.mimes' => 'L’image principale doit être au format JPG, JPEG, PNG ou WEBP.',
            'image.max' => 'L’image principale ne doit pas dépasser 5 Mo.',

            'gallery.array' => 'Le format de la galerie est invalide.',
            'gallery.max' => 'La galerie ne peut pas contenir plus de 10 fichiers.',
            'gallery.*.image' => 'Chaque fichier de la galerie doit être une image valide.',
            'gallery.*.mimes' => 'Les images doivent être au format JPG, JPEG, PNG ou WEBP.',
            'gallery.*.max' => 'Chaque image ne doit pas dépasser 5 Mo.',
        ];
    }
}
