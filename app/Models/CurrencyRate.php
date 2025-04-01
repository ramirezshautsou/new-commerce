<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    protected $table = 'currency_rates';

    protected $fillable = [
        'currency',
        'rate',
    ];

    protected $casts = [
        'rate' => 'float',
    ];
}
