<?php

namespace Database\Seeders;

use App\Models\VillageField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VillageFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            //
            VillageField::factory()
                ->count(1)
                ->create();
        }
    }
}
