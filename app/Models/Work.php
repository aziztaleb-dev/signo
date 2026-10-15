<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Work extends Model
{
    protected $table = 'works';

    protected $fillable = [
        'work_subcategory_id',
        'title',
        'title_en',
        'slug',
        'images',
        'description',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function (Work $work) {
            if ($work->isDirty(['title', 'work_subcategory_id']) || empty($work->slug)) {
                $work->slug = static::uniqueSlug($work);
            }
        });
    }

    /**
     * Slug unique dans la sous-catégorie du travail.
     */
    protected static function uniqueSlug(Work $work): string
    {
        $base = Str::slug($work->title) ?: 'travail';
        $slug = $base;
        $i = 2;

        while (
        static::where('work_subcategory_id', $work->work_subcategory_id)
            ->where('slug', $slug)
            ->when($work->exists, fn ($query) => $query->where('id', '!=', $work->id))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(WorkSubcategory::class, 'work_subcategory_id');
    }
}
