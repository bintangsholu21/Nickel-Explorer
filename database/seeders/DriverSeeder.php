<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::create([
            'name' => 'Agus mulyadi',
        ]);

        Driver::create([
            'name' => 'Fuad Alfarizi',
        ]);

        Driver::create([
            'name' => 'Rizky Ramadhan',
        ]);

        Driver::create([
            'name' => 'Agil Pratama',
        ]);

        Driver::create([
            'name' => 'Rizky Ramadhan',
        ]);

        Driver::create([
            'name' => 'Ahmad Fauzi',
        ]);

        Driver::create([
            'name' => 'Bagus Pratama',
        ]);

        Driver::create([
            'name' => 'Doni Laksana',
        ]);
    }
}
