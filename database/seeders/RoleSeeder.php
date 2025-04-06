<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Role::query()->create([
            'name' => 'admin',
        ]);

        Role::query()->create([
            'name' => 'user',
        ]);
    }
}
