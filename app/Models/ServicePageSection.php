<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePageSection extends Model
{
    protected $fillable = [
        'key',
        'name',
        'title',
        'subtitle',
        'paragraphs',
        'items',
        'quote',
        'quote_author',
        'image',
        'gallery',
        'button_text',
        'button_url',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'paragraphs' => 'array',
            'items' => 'array',
            'gallery' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
