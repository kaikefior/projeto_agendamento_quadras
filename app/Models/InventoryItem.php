<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    //campos permitidos no preenchimento em massa
    protected $fillable =[
        'name',
        'type',
        'description',
        'quantity',
        'unit_price',
    ];
}
