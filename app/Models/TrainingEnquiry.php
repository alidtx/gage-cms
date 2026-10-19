<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// app/Models/TrainingEnquiry.php
class TrainingEnquiry extends Model
{
    protected $fillable = [
        'programme_id', 'programme_label', 'full_name', 'organisation',
        'email', 'phone', 'participants', 'delivery_preference',
        'notes', 'status', 'source_page', 'submitted_ip',
    ];

    protected $casts = [
        'participants' => 'integer',
    ];

    public function programme(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'programme_id');
    }
}
