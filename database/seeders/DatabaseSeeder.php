<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            ProducerSeeder::class,
        ]);

        $this->call([
            ServiceSeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
        ]);

        $this->call([
            ProductServiceSeeder::class,
        ]);

        User::factory(10)->create();
    }
}
