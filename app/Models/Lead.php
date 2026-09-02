<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    protected $fillable = [
        'assigned_user_id',
        'full_name',
        'phone',
        'email',
        'budget',
        'purchase_purpose',
        'payment_method',
        'source',
        'status',
        'notes',
    ];

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function units(): BelongsToMany
{
    return $this->belongsToMany(Unit::class, 'lead_units')
        ->withPivot('interest_status', 'notes')
        ->withTimestamps();
}

public function activities(): HasMany{
    return $this->hasMany(Activity::class);
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