<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class GlobalSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_description',
        'site_keywords',
        'author',
        'publisher',
        'facebook_app_id',
        'twitter_site',
        'google_analytics_id',
        'google_tag_manager_id',
    ];

    public function defaultOgImage(): MorphOne
    {
        return $this->morphOne(Media::class, 'fileable')
            ->where('name', 'Default OG Image');
    }

    public function defaultTwitterImage(): MorphOne
    {
        return $this->morphOne(Media::class, 'fileable')
            ->where('name', 'Default Twitter Image');
    }
}