<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Category::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'alias' => $this->faker->slug,
            'parent_id' => Category::query()->inRandomOrder()->first()?->id,
        ];
    }
}
