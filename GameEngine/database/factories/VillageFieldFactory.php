<?php

namespace Database\Factories;

use App\Models\VillageField;
use Illuminate\Database\Eloquent\Factories\Factory;

class VillageFieldFactory extends Factory
{
    protected $model = VillageField::class;

    public function definition(): array
    {
    	return [
            'id_village' => 1,
            'field' => 1,
            'building' => 1,
            'level' => 1,
            'is_resource' => 1,
    	];
    }
}
