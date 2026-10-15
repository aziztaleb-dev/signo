<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServicePageSectionRequest extends FormRequest
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

            'items' => ['nullable', 'array'],
            'items.*.title' => ['nullable', 'string', 'max:255'],
            'items.*.text' => ['nullable', 'string'],

            'quote' => ['nullable', 'string'],
            'quote_author' => ['nullable', 'string', 'max:255'],

            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:2048'],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'remove_image' => ['nullable', 'boolean'],

            'gallery' => ['nullable', 'array', 'max:10'],
            'gallery.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['string', 'max:2048'],

            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'subtitle.max' => 'Le sous-titre ne doit pas dépasser 255 caractères.',

            'image.image' => 'Le fichier principal doit être une image valide.',
            'image.mimes' => 'L’image principale doit être au format JPG, JPEG, PNG ou WEBP.',
            'image.max' => 'L’image principale ne doit pas dépasser 5 Mo.',

            'gallery.max' => 'Vous pouvez ajouter au maximum 10 images à la fois.',
            'gallery.*.image' => 'Chaque fichier de la galerie doit être une image valide.',
            'gallery.*.mimes' => 'Les images de la galerie doivent être au format JPG, JPEG, PNG ou WEBP.',
            'gallery.*.max' => 'Chaque image de la galerie ne doit pas dépasser 5 Mo.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'titre',
            'subtitle' => 'sous-titre',
            'image' => 'image principale',
            'gallery' => 'galerie',
            'button_text' => 'texte du bouton',
            'button_url' => 'lien du bouton',
        ];
    }
}
