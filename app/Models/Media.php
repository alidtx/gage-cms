<?php

namespace App\Models;

use App\Enum\MediaType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'src',
        'type',
        'extension',
        'fileable_id',
        'fileable_type',
        'document_type_id',
    ];

    public function casts(): array
    {
        return [
            'type' => MediaType::class,
        ];
    }

    public function path(): Attribute
    {
        if (Storage::exists($this->src)) {
            $path = Storage::url($this->src);
        } else {
            $path = Storage::url('images/dummies/logo-icon.png');
        }

        return new Attribute(
            get: fn () => $path
        );
    }

    public function fileable()
    {
        return $this->morphTo();
    }
}
