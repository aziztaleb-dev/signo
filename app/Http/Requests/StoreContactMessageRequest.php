<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest

{
    protected $redirect = '/contact#contact-form';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Le nom est obligatoire.',
            'name.max'         => 'Le nom ne doit pas dépasser 255 caractères.',
            'email.required'   => "L'adresse email est obligatoire.",
            'email.email'      => "L'adresse email n'est pas valide.",
            'email.max'        => "L'adresse email ne doit pas dépasser 255 caractères.",
            'phone.max'        => 'Le téléphone ne doit pas dépasser 50 caractères.',
            'subject.max'      => 'Le sujet ne doit pas dépasser 255 caractères.',
            'message.required' => 'Le message est obligatoire.',
            'message.max'      => 'Le message ne doit pas dépasser 5000 caractères.',
        ];
    }
}
