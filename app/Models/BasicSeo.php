<?php
// app/Models/BasicSeo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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

    protected $appends = [
        'social_share_image',
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'fileable');
    }

    public function socialShareImage(): Attribute
    {
        return new Attribute(
            get: fn () => $this->seoImage ? $this->seoImage->path : ''
        );
    }

    public function seoImage(): MorphOne
    {
        return $this->morphOne(Media::class, 'fileable')
            ->where('name', 'Social Share Image')
            ->latest();
    }
}