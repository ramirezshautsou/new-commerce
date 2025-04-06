<?php

namespace Database\Factories;

use App\Models\ProductService;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProductServiceFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = ProductService::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->first()?->id,
            'service_id' => Service::query()->inRandomOrder()->first()?->id,
        ];
    }
}
