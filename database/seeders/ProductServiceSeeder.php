<?php

namespace Database\Seeders;

use App\Models\ProductService;
use Illuminate\Database\Seeder;

class ProductServiceSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        ProductService::factory()->count(20)->create();
    }
}
