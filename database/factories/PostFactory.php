<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
             'content'=>$this->faker->text(100, true),
            'description' => $this->faker->sentence(6, true),
            'preview_path' => $this->faker->url(),
            'profile_id' => $this->faker->numberBetween(1, 10),
            'views' => $this->faker->numberBetween(0, 5),
        ];
    }
}
