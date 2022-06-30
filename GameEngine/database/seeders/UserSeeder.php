<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Village;

class UserSeeder extends Seeder
{
    // Run the database seeds
    public function run()
    {
        User::factory()
            ->count(20)
            ->hasVillages(1, function (array $attributes, User $user) {
                return ['name' => $user->name . "'s village "];
            })
            ->create();
    }
}
