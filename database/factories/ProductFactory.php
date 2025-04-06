<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Producer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProductFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Product::class;

    /**
     * @return array
     */
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
