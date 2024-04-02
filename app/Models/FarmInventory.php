<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'input_name',
        'quantity',
        'unit_price',
        'total',
        'purchase_date',
    ];
}
