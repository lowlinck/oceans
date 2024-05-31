<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Получаем случайную модель для полиморфной связи
        $fileable = $this->faker->randomElement([
            User::class,
            Post::class,
        ]);

        return [
            'url' => $this->faker->filePath(),
            'fileable_id' => $fileable::factory(), // Создание и получение ID связанной модели
            'fileable_type' => $fileable,
        ];
    }
}
