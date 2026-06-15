<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@asset.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // Password default: password
                'role_id' => $adminRole->id,
            ]
        );
    }
}
