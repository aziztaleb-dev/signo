<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkSubcategory extends Model
{
    protected $table = 'work_subcategories';

    protected $fillable = [
        'work_category_id',
        'name',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(WorkCategory::class, 'work_category_id');
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class, 'work_subcategory_id');
    }
}
