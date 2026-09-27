<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
     protected $fillable = [
        'site_name',
        'site_description',
        'site_keywords',
        'default_og_image',
        'default_twitter_image',
    ];
}
