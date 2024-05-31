<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;

/**
 * Сервис для заполнения категорий комментариями и постами.
 * Реализует интерфейс SeederServiceInterface.
 */
class CategorySeederService implements SeederServiceInterface
{
    /**
     * Метод для выполнения всех операций по заполнению данных.
     */
    public function seed()
    {
        $this->seedCategoriesWithComments();
        $this->seedCategoriesWithPosts();
    }

    /**
     * Метод для заполнения категорий комментариями.
     * Получает все комментарии и случайным образом присваивает им категории.
     */
    private function seedCategoriesWithComments()
    {
        // Получаем все id категорий
        $categoryIds = Category::pluck('id')->toArray();
        // Получаем все комментарии
        $comments = Comment::all();
        // Присваиваем каждому комментарию случайные категории
        foreach ($comments as $comment) {
            $randomCategoryIds = $this->getRandomIds($categoryIds);
            $attachData = $this->getAttachData($randomCategoryIds);
            $comment->categories()->syncWithoutDetaching($attachData);
        }
    }

    /**
     * Метод для заполнения категорий постами.
     * Получает все посты и случайным образом присваивает им категории.
     */
    private function seedCategoriesWithPosts()
    {
        // Получаем все id категорий
        $categoryIds = Category::pluck('id')->toArray();
        // Получаем все посты
        $posts = Post::all();
        // Присваиваем каждому посту случайные категории
        foreach ($posts as $post) {
            $randomCategoryIds = $this->getRandomIds($categoryIds);
            $attachData = $this->getAttachData($randomCategoryIds);
            $post->categories()->syncWithoutDetaching($attachData);
        }
    }

    /**
     * Метод для получения случайных id из массива.
     * @param array $ids - массив id.
     * @return array - случайные id.
     */
    private function getRandomIds($ids)
    {
        // Возвращаем случайные id из массива
        return collect($ids)->random(rand(1, count($ids)))->toArray();
    }

    /**
     * Метод для получения данных для присоединения (attach).
     * Генерирует данные с датами создания и обновления.
     * @param array $ids - массив id.
     * @return array - данные для присоединения.
     */
    private function getAttachData($ids)
    {
        $attachData = [];
        foreach ($ids as $id) {
            $attachData[$id] = [
                'created_at' => Carbon::now()->subDays(rand(0, 365))->toDateTimeString(),
                'updated_at' => Carbon::now()->subDays(rand(0, 365))->toDateTimeString()
            ];
        }
        return $attachData;
    }
}
