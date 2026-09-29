<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'title',
        'icon',
        'description',
        'entity_id',
        'badge',
        'media_id',
    ];

   
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

 
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

   
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
}