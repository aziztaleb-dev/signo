<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactPageSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],

            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],

            'data' => ['nullable', 'array'],

            'data.phones' => ['nullable', 'array', 'max:10'],
            'data.phones.*.label' => ['nullable', 'string', 'max:50'],
            'data.phones.*.value' => ['nullable', 'string', 'max:50'],

            'data.facebook' => ['nullable', 'url', 'max:2048'],
            'data.pinterest' => ['nullable', 'url', 'max:2048'],
            'data.instagram' => ['nullable', 'url', 'max:2048'],
            'data.whatsapp' => ['nullable', 'url', 'max:2048'],

            'data.button_text' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'image.image' => 'Le fichier doit être une image valide.',
            'image.mimes' => 'Les formats autorisés sont JPG, JPEG, PNG et WEBP.',
            'image.max' => 'L’image ne doit pas dépasser 5 Mo.',
            'data.facebook.url' => 'Le lien Facebook doit être une URL valide.',
            'data.pinterest.url' => 'Le lien Pinterest doit être une URL valide.',
            'data.instagram.url' => 'Le lien Instagram doit être une URL valide.',
            'data.whatsapp.url' => 'Le lien WhatsApp doit être une URL valide.',
        ];
    }
}
