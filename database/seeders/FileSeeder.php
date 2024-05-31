<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\File;
use App\Models\Post;
use App\Models\Category;

class FileSeeder extends Seeder
{
    public function run(): void
    {
        // Привязка файлов к постам
        Post::all()->each(function ($post) {
            $post->files()->saveMany(File::factory()->count(3)->make());
        });

        // Привязка файлов к категориям
        Category::all()->each(function ($category) {
            $category->files()->saveMany(File::factory()->count(3)->make());
        });
    }
}
