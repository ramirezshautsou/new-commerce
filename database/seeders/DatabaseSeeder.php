<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Producer;
use App\Models\Product;
use App\Models\ProductService;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            ServiceTypeSeeder::class,
            CategorySeeder::class,
            ProducerSeeder::class,
        ]);

        $this->call([
            ServiceSeeder::class,
            ProductSeeder::class,
        ]);

        $this->call([
            ProductServiceSeeder::class,
        ]);
    }
}
