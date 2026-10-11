<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewProduct extends Model
{
    protected $table = 'new_products';

    protected $fillable = [
        'name',
        'images',
        'description',
        'pdf',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
