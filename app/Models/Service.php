<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_services');
    }
}
