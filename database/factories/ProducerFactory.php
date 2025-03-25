<?php

namespace Database\Factories;

use App\Models\Producer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProducerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Producer::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'alias' => $this->faker->slug,
        ];
    }
}
