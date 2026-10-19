<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// app/Models/ProgrammeObjective.php
class ProgrammeObjective extends Model
{
    protected $fillable = ['programme_id', 'body', 'sort_order'];

    protected $casts = ['sort_order' => 'integer'];

    public function programme(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
