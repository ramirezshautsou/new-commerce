<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Base Admin',
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        $role = Role::query()->find(2);

        if ($role) {
            User::query()->create([
                'name' => 'Base User',
                'email' => 'user@user.com',
                'password' => bcrypt('password'),
                'role_id' => $role->id,
            ]);
        }
    }
}
