<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IslandReachSetting extends Model
{
     protected $fillable = [
        'name',
        'atoll',
        'description',
        'latitude',
        'longitude',
        'location_type',
        'is_featured',
        'marker_color',
        'marker_icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
