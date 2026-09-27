<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
   protected $fillable = [
        'title',
        'bio',
        'description',
        'media_id',
        'badge',
    ];
}
