<?php

namespace Database\Seeders;

use App\Models\Services\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceType::factory()->count(3)->create();
    }
}
