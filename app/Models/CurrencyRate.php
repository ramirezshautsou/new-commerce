<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'currency_rates';

    /**
     * @var string[]
     */
    protected $fillable = [
        'currency',
        'rate',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'rate' => 'float',
    ];
}
