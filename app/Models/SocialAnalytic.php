<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAnalytic extends Model
{
     protected $fillable = [
        'author',
        'publisher',
        'facebook_app_id',
        'twitter_site',
        'google_analytics_id',
        'google_tag_manager_id',
    ];
}
