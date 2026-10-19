<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

// app/Models/ProgrammeGroup.php
class ProgrammeGroup extends Model
{
    protected $fillable = ['slug', 'name', 'sort_order'];

    protected $casts = ['sort_order' => 'integer'];

    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class, 'programme_group_id');
    }

    public function programmes(): HasManyThrough
    {
        return $this->hasManyThrough(Program::class, Division::class, 'programme_group_id', 'division_id');
    }
}