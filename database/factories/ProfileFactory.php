<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::pluck('id')->random(),
            'first_name' =>$this->faker->firstName(),
            'second_name' =>$this->faker->lastName(),
            'is_married' =>$this->faker->boolean(),
            'birthed_at' =>$this->faker->date(),
            'gender' =>$this->faker->randomElement(['male', 'female', 'non-binary', 'other']),
            'age' =>$this->faker->numberBetween(18, 65),
        ];
    }
}
