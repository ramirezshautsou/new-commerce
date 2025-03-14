<?php

namespace Database\Factories;

use App\Models\Products\Category;
use App\Models\Products\Producer;
use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'alias' => $this->faker->slug,
            'category_id' => Category::query()->inRandomOrder()->first()?->id,
            'producer_id' => Producer::query()->inRandomOrder()->first()?->id,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 9999),
            'production_date' => $this->faker->date(),
        ];
    }
}
