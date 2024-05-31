<?php
// database/seeders/ImageSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        // Привязка изображений к постам
        Post::all()->each(function ($post) {
            $post->images()->saveMany(Image::factory()->count(3)->make());
        });

        // Привязка изображений к категориям
        Category::all()->each(function ($category) {
            $category->images()->saveMany(Image::factory()->count(3)->make());
        });

        // Привязка изображений к комментариям
        Comment::all()->each(function ($comment) {
            $comment->images()->saveMany(Image::factory()->count(3)->make());
        });
    }
}
