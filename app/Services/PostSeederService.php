<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Сервис для заполнения постов комментариями, тегами и лайками.
 * Реализует интерфейс SeederServiceInterface.
 */
class PostSeederService implements SeederServiceInterface
{
    /**
     * Метод для выполнения всех операций по заполнению данных.
     */
    public function seed()
    {
        $this->seedPostsWithCommentsTagsAndLikes();
    }

    /**
     * Метод для заполнения постов комментариями, тегами и лайками.
     * Получает все посты и случайным образом присваивает им комментарии, теги и лайки.
     */
    private function seedPostsWithCommentsTagsAndLikes()
    {
        // Получаем все id комментариев, тегов и профилей
        $commentIds = Comment::pluck('id')->toArray();
        $tagIds = Tag::pluck('id')->toArray();
        $profileIds = Profile::pluck('id')->toArray();

        // Логируем доступные id для отладки
        Log::info('Available comment IDs: ', $commentIds);
        Log::info('Available tag IDs: ', $tagIds);
        Log::info('Available profile IDs: ', $profileIds);

        // Получаем все посты
        $posts = Post::all();
        // Присваиваем каждому посту случайные комментарии, теги и лайки
        foreach ($posts as $post) {
            // Привязка комментариев
            $randomCommentIds = $this->getRandomIds($commentIds);
            $attachDataComments = $this->getAttachData($randomCommentIds);
            $post->comments()->syncWithoutDetaching($attachDataComments);

            // Привязка тегов
            $randomTagIds = $this->getRandomIds($tagIds);
            $attachDataTags = $this->getAttachData($randomTagIds);
            $post->tags()->syncWithoutDetaching($attachDataTags);

            // Привязка лайков
            $randomProfileIds = $this->getRandomIds($profileIds);
            foreach ($randomProfileIds as $profileId) {
                // Проверка существующих лайков
                $existingLike = DB::table('likes')
                    ->where('post_id', $post->id)
                    ->where('profile_id', $profileId)
                    ->exists();

                // Если лайк не существует, создаем его
                if (!$existingLike) {
                    DB::table('likes')->insert([
                        'post_id' => $post->id,
                        'profile_id' => $profileId,
                        'created_at' => Carbon::now()->subDays(rand(0, 365))->toDateTimeString(),
                        'updated_at' => Carbon::now()->subDays(rand(0, 365))->toDateTimeString()
                    ]);
                }
            }
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
