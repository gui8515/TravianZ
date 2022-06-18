<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'description' => $this->faker->sentence,
            'birthday' => $this->faker->date,
            'location' => $this->faker->country,
            'id_tribe' => $this->faker->numberBetween(1, 6),
            'id_alliance' => $this->faker->numberBetween(1, 200),
            'is_plus' => $this->faker->boolean,
            'is_gold' => $this->faker->boolean,
            'is_protected' => $this->faker->boolean,
            'is_online' => $this->faker->boolean,
            'is_banned' => $this->faker->boolean,
            'plus_expires_at' => $this->faker->unixTime( 'now' + $this->faker->numberBetween(1, 7) * 24 * 60 * 60 ),
            'gold_expires_at' => $this->faker->unixTime( 'now' + $this->faker->numberBetween(1, 30) * 24 * 60 * 60 ),
            'protect_expires_at' => $this->faker->unixTime( 'now' + $this->faker->numberBetween(1, 7) * 24 * 60 * 60 ),
            'last_online' => $this->faker->unixTime('now'),
            'activated_at' => $this->faker->unixTime('now'),
            'banned_at' => null,
            'access_level' => 1,
            'remember_token' => Str::random(10)
        ];
    }
}
