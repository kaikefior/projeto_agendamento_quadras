<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Court extends Model
{
    protected $fillable = [
        'name',
        'sport_type',
        'description',
        'status',
    ];
    // Uma quadra pode ter várias reservas, ligadas pelo court_id.
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
};
