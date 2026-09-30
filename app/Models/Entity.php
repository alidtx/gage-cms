<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Entity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'category',
        'is_active', 'is_featured', 'sort_order',
        'content', 'meta', 'media_id',
    ];

    protected $casts = [
        'content' => 'array',
        'meta'    => 'array',
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($entity) {
            $entity->slug ??= Str::slug($entity->name);
        });
    }

    // ---------------- Convenience accessors ----------------

    public function getHeroAttribute(): array
    {
        return $this->content['hero'] ?? [];
    }

    public function getContactAttribute(): array
    {
        return $this->content['contact'] ?? [];
    }

    public function getMetaTitleAttribute(): ?string
    {
        return $this->meta['meta_title'] ?? $this->name;
    }

    public function getShortDescriptionAttribute(): ?string
    {
        return $this->meta['short_description'] ?? null;
    }

    public function getIconAttribute(): string
    {
        return $this->meta['icon'] ?? '🏢';
    }

    /**
     * Safe dot-notation access into the content JSON.
     * Example: $entity->content('hero.title_line_1', 'Default')
     */
    public function content(string $path = null, $default = null)
    {
        if ($path === null) return $this->content ?? [];
        return Arr::get($this->content ?? [], $path, $default);
    }

    /**
     * Safe dot-notation access into the meta JSON.
     */
    public function meta(string $path = null, $default = null)
    {
        if ($path === null) return $this->meta ?? [];
        return Arr::get($this->meta ?? [], $path, $default);
    }

    /**
     * Get a section by its key (e.g. 'services', 'systems').
     */
    public function section(string $key): array
    {
        return collect($this->content['sections'] ?? [])
            ->firstWhere('key', $key) ?? [];
    }

    // ---------------- Scopes ----------------

    public function scopeActive($q)      { return $q->where('is_active', true); }
    public function scopeFeatured($q)    { return $q->where('is_featured', true); }
    public function scopeOrdered($q)     { return $q->orderBy('sort_order')->orderBy('name'); }
    public function scopeCategory($q, $c){ return $q->where('category', $c); }

    public function getRouteAttribute(): string
    {
        return route('entities.show', $this->slug);
    }
}