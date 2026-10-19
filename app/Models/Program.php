<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * Laravel would infer "programs" from the class name, but the schema
     * (and the site's own vocabulary) uses "programmes".
     */
    protected $table = 'programmes';

    /**
     * Mass-assignable attributes.
     */
    protected $fillable = [
        'division_id',
        'position',
        'code',
        'title',
        'meta_line',
        'search_text',
        'link_url',
        'link_anchor',
        'duration',
        'class_size',
        'prerequisite',
        'aim',
        'description',
        'participants',
        'sort_order',
        'is_published',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'division_id' => 'integer',
        'position' => 'integer',
        'sort_order' => 'integer',
        'is_published' => 'boolean',
    ];

    /**
     * Default values for new instances.
     */
    protected $attributes = [
        'is_published' => true,
        'sort_order' => 0,
    ];

    /* -----------------------------------------------------------------
     |  Relationships
     | ----------------------------------------------------------------- */

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function objectives(): HasMany
    {
        return $this->hasMany(ProgrammeObjective::class, 'programme_id')->orderBy('sort_order');
    }

    public function enquiries(): HasMany
    {
        return $this->hasMany(TrainingEnquiry::class, 'programme_id');
    }

    /* -----------------------------------------------------------------
     |  Scopes
     | ----------------------------------------------------------------- */

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('position');
    }

    /* -----------------------------------------------------------------
     |  Accessors
     | ----------------------------------------------------------------- */

    /**
     * Display code shown on the front-end, e.g. "1.6" or "10.5".
     * Falls back to `position` if the division isn't loaded.
     */
    public function getDisplayCodeAttribute(): string
    {
        $divisionNumber = $this->division?->number;

        return $divisionNumber !== null
            ? "{$divisionNumber}.{$this->position}"
            : (string) $this->position;
    }
}
