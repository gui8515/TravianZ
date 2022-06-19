<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class DatabaseSeeder extends Seeder
{
    // use WithoutModelEvents;

    // Run the database seeds.
    public function run()
    {
        $this->call([
            UserSeeder::class,
            VillageSeeder::class,
            VillageFieldSeeder::class,
        ]);

    }
}
