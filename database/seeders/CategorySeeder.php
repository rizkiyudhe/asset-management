<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Elektronik', 'description' => 'Perangkat elektronik dan IT'],
            ['name' => 'Kendaraan', 'description' => 'Kendaraan operasional'],
            ['name' => 'Furnitur', 'description' => 'Perabotan kantor'],
        ]);
    }
}
