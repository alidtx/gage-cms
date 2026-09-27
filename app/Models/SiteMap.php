<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteMap extends Model
{
    protected $fillable = [
        'content_type',
        'include',
        'priority',
        'change_frequency',
    ];

    protected $casts = [
        'include' => 'boolean',
        'priority' => 'decimal:1',
    ];
    
}
