<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingFactory extends Factory
{
    protected $model = Building::class;

    public function definition(): array
    {
        // get the village id
        $village = Village::factory()->create();

        return [
            'village_id' => $village['id'],
            'field' => $this->faker->numberBetween(1, 40),
            'build_type' => $this->faker->numberBetween(1, 44),
            'level' => $this->faker->numberBetween(1, 20),
            'is_resource' => false,
            'is_building' => false,
            'is_upgrading' => false,
            'is_constructed' => false,
            'is_destroyed' => false,
            'is_occupied' => false,
        ];
    }
}
