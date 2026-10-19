<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// app/Models/Division.php
class Division extends Model
{
    protected $fillable = [
        'programme_group_id', 'number', 'slug', 'name', 'description',
        'hero_image_path', 'hero_alt', 'detail_url',
        'cta_heading', 'cta_body', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'number'       => 'integer',
        'sort_order'   => 'integer',
        'is_published' => 'boolean',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(ProgrammeGroup::class, 'programme_group_id');
    }

    public function programmes(): HasMany
    {
        return $this->hasMany(Program::class)->orderBy('sort_order');
    }
}
