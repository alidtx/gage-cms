<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entity extends Model
{
    use HasFactory;

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    protected $fillable = [
        'title',
        'bio',
        'description',
        'media_id',
        'badge',
    ];
}
