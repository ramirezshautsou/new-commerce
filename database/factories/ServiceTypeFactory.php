<?php

namespace Database\Factories;

use App\Models\Services\ServiceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Services\ServiceType>
 */
class ServiceTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ServiceType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
