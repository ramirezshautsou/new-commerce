<?php

namespace Database\Factories;

use App\Models\Products\Producer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products\Producer>
 */
class ProducerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Producer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'alias' => $this->faker->slug,
        ];
    }
}
