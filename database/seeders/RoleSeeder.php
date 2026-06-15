<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Administrator Sistem'],
            ['name' => 'staff_asset', 'description' => 'Staff Manajemen Aset'],
            ['name' => 'manager', 'description' => 'Manager / Pimpinan'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
