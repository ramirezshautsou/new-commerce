<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Admin',
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        $role = Role::query()->find(2);

        if ($role) {
            User::query()->create([
                'name' => 'Dr. Natasha Jacobs',
                'email' => 'jody.jones@example.com',
                'password' => bcrypt('password'),
                'role_id' => $role->id,
            ]);
        }
    }
}
