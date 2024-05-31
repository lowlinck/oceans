<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Получаем случайную модель для полиморфной связи
        $imageable = $this->faker->randomElement([
            User::class,
            Post::class,
        ]);

        return [
            'url' => $this->faker->imageUrl(),
            'imageable_id' => $imageable::factory(), // Создание и получение ID связанной модели
            'imageable_type' => $imageable,
        ];
    }

}
