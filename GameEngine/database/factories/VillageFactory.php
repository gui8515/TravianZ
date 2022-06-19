<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\ArrayKey;

use function PHPUnit\Framework\isNull;

class VillageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Village::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all('id', 'name')->toArray();
        $user = $this->faker->randomElement($users);
        // $user['id'] = 1;

        $villages = Village::all('id', 'name', 'is_capital', 'id_user')
            ->where('id_user', '=', $user['id'])
            ->toArray();

        $village = $this->faker->randomElement($villages);

        // If user has no capital village, create one
        if (sizeof($villages) == 0) {
            $is_capital = true;
            $village = ['id' => null];
        } else {
            $is_capital = false;
        }


        // dd($villages, 'village selecter', $village);

        return [
            'id_user' => $user['id'],
            'name' => $user['name']."'s village",
            'is_capital' => $is_capital,
            'id_village' => $village['id'],
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
