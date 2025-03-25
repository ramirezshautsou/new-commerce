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
     * Define the model's default state.
     *
     * @return array<string, mixed>
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
