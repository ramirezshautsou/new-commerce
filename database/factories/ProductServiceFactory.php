<?php

namespace Database\Factories;

use App\Models\Relations\ProductService;
use App\Models\Products\Product;
use App\Models\Services\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Relations\ProductService>
 */
class ProductServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductService::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->first()?->id,
            'service_id' => Service::query()->inRandomOrder()->first()?->id,
        ];
    }
}
