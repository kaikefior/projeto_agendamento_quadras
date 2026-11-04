<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    // A reserva pertence a uma quadra, ligada pelo court_id.
    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    } 

    // A reserva pertence a um usuário, ligado pelo user_id.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
