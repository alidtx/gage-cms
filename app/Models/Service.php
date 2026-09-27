<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
     protected $fillable = [
        'title',
        'icon',
        'description',
        'entity_id',
        'badge',
        'media_id',
    ];
}
