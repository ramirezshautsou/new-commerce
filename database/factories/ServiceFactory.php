<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ServiceFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Service::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'alias' => $this->faker->slug,
            'target_date' => $this->faker->date(),
            'price' => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}
