<?php
// app/Models/BasicSeo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasicSeo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'meta_description',
        'keywords',
        'og_title',
        'og_type',
        'og_description',
        'media_id',
        'canonical_url',
        'schema_type',
        'custom_schema',
        'twitter_title',
        'twitter_card_type',
        'twitter_description',
    ];

    protected $casts = [
        'custom_schema' => 'array',
    ];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
}