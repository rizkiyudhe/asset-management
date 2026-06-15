<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::insert([
            ['name' => 'Gedung Utama - Lantai 1', 'description' => 'Kantor pusat lantai dasar'],
            ['name' => 'Gedung Utama - Lantai 2', 'description' => 'Ruang manajemen'],
            ['name' => 'Gudang Pusat', 'description' => 'Penyimpanan aset utama'],
        ]);
    }
}
