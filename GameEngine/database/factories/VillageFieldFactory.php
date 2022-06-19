<?php

namespace Database\Factories;

use App\Models\VillageField;
use Illuminate\Database\Eloquent\Factories\Factory;
// USE App\Providers\Data\ResourceFields;

class VillageFieldFactory extends Factory
{
    protected $model = VillageField::class;

    public function definition(): array
    {
        // Randomly select a field from the list of fields
        // $resourceFields = ResourceFields::get();
        // $typeField = $this->faker->randomElement($resourceFields);

        // create array fields with name and level
        // $villageFields = [];
        // for($i = 1; $i <= 18; $i++) {
        //     $villageFields['field'] = $typeField[$i];
        //     $villageFields['level'] = $this->faker->numberBetween(1, 20);
        // }


        // dd($villageFields);
        return [];
    }
}
