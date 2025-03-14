<?php

namespace Database\Seeders;

use App\Models\Relations\ProductService;
use Illuminate\Database\Seeder;

class ProductServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductService::factory()->count(20)->create();
    }
}
