<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;

class VillageFactory extends Factory
{
    // The model that is being created
    protected $model = Village::class;

    public function definition()
    {
        // dd($villages, 'village selecter', $village);
        return [
            'is_capital' => 1,
            'village_id' => null,
            'population' => $this->faker->numberBetween(1, 1000),
            'loyalty' => $this->faker->numberBetween(70, 100),
            'culture' => $this->faker->numberBetween(1, 500),
            'culture_max' => $this->faker->numberBetween(500, 4000),
            'wood' => $this->faker->numberBetween(0, 2000),
            'wood_max' => $this->faker->numberBetween(800, 2000),
            'clay' => $this->faker->numberBetween(0, 2000),
            'clay_max' => $this->faker->numberBetween(800, 2000),
            'iron' => $this->faker->numberBetween(0, 2000),
            'iron_max' => $this->faker->numberBetween(800, 2000),
            'crop' => $this->faker->numberBetween(0, 2000),
            'crop_max' => $this->faker->numberBetween(800, 2000),
            'wood_prod' => $this->faker->numberBetween(1, 100),
            'clay_prod' => $this->faker->numberBetween(1, 100),
            'iron_prod' => $this->faker->numberBetween(1, 100),
            'crop_prod' => $this->faker->numberBetween(1, 100),
            'wood_bonus' => $this->faker->numberBetween(1, 100),
            'clay_bonus' => $this->faker->numberBetween(1, 100),
            'iron_bonus' => $this->faker->numberBetween(1, 100),
            'crop_bonus' => $this->faker->numberBetween(1, 100),
        ];
    }
}
