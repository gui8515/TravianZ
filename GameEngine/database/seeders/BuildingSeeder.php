<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    // Run the database seeds.
    public function run()
    {

        Building::factory()
            ->count(1)
            ->create();
    }
}
