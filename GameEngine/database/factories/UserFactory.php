<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
            'uuid' => $this->faker->uuid,
            'name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make(12345668),
            'description' => $this->faker->sentence,
            'birthday' => $this->faker->date,
            'location' => $this->faker->city,
            'id_tribe' => $this->faker->numberBetween(1, 6),
            'id_alliance' => $this->faker->numberBetween(1, 200),
            'is_plus' => $this->faker->boolean,
            'is_gold' => $this->faker->boolean,
            'is_protected' => $this->faker->boolean,
            'is_online' => $this->faker->boolean,
            'is_banned' => $this->faker->boolean,
            'plus_expires_at' => $this->faker->dateTimeBetween('now', '+1 week'),
            'gold_expires_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'protect_expires_at' => $this->faker->dateTimeBetween('now', '+1 day'),
            'last_online' => $this->faker->dateTimeBetween('-1 day', 'now'),
            'activated_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'banned_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'access_level' => 1,
            'remember_token' => $this->faker->regexify('[A-Za-z0-9]{10}'),
        ];
    }
}
