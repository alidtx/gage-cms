<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicSeo extends Model
{
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
}
