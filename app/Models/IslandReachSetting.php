<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class IslandReachSetting extends Model
{
    use HasFactory;

    protected $table = 'island_reach_settings';

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
        'latitude'     => 'decimal:7',
        'longitude'    => 'decimal:7',
        'is_featured'  => 'boolean',
        'is_active'    => 'boolean',
        'sort_order'   => 'integer',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    protected $attributes = [
        'location_type' => 'island',
        'marker_color'  => '#3388ff',
        'is_featured'   => false,
        'is_active'     => true,
        'sort_order'    => 0,
    ];

    /* -------------------------
     |  Scopes
     |------------------------- */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function scopeByAtoll(Builder $query, string $atoll): Builder
    {
        return $query->where('atoll', $atoll);
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('location_type', $type);
    }

    /* -------------------------
     |  Accessors
     |------------------------- */

    public function getCoordinatesAttribute(): ?array
    {
        if ($this->latitude === null || $this->longitude === null) {
            return null;
        }

        return [
            'lat' => (float) $this->latitude,
            'lng' => (float) $this->longitude,
        ];
    }
}