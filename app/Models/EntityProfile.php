<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityProfile extends Model
{
    protected $fillable = [
        'entity_id',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];
}
