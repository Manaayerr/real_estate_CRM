<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    protected $fillable = [
        'project_id',
        'unit_number',
        'type',
        'area',
        'price',
        'status',
        'description',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function leads(): BelongsToMany
{
    return $this->belongsToMany(Lead::class, 'lead_units')
        ->withPivot('interest_status', 'notes')
        ->withTimestamps();
}

public function appointments(): HasMany
{
    return $this->hasMany(Appointment::class);
}

public function deals()
{
    return $this->hasMany(Deal::class);
}

}