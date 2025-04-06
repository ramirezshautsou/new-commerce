<?php

namespace Database\Seeders;

use App\Models\Producer;
use Illuminate\Database\Seeder;

class ProducerSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Producer::factory()->count(5)->create();
    }
}
