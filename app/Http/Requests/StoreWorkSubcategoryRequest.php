<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkSubcategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'work_category_id' => ['required', 'integer', 'exists:work_categories,id'],
            'name'             => [
                'required',
                'string',
                'max:255',
                Rule::unique('work_subcategories', 'name')
                    ->where('work_category_id', $this->input('work_category_id')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'work_category_id.required' => 'Veuillez sélectionner une catégorie.',
            'work_category_id.integer'  => 'La catégorie sélectionnée est invalide.',
            'work_category_id.exists'   => "La catégorie sélectionnée n'existe pas.",
            'name.required'             => 'Le nom de la sous-catégorie est obligatoire.',
            'name.string'               => 'Le nom doit être une chaîne de caractères.',
            'name.max'                  => 'Le nom ne doit pas dépasser 255 caractères.',
            'name.unique'               => 'Cette sous-catégorie existe déjà dans cette catégorie.',
        ];
    }
}
