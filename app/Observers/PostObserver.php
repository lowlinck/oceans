<?php

namespace App\Observers;

use App\Models\Post;
use App\Traits\LogsModelEvents;
use App\Enums\OperationTypes;

/**
 * Наблюдатель за моделью Post.
 * Обрабатывает события, связанные с моделью Post, и логирует их.
 */
class PostObserver
{
    use LogsModelEvents;

    /**
     * Обрабатывает событие "создания" модели Post.
     *
     * @param Post $post
     */
    public function created(Post $post): void
    {
        logger()->info('PostObserver: created event');
        self::logOperationForModel($post, OperationTypes::CREATED()->getValue());
    }

    /**
     * Обрабатывает событие "обновления" модели Post.
     *
     * @param Post $post
     */
    public function updated(Post $post): void
    {
        logger()->info('PostObserver: updated event');
        $postData = $post->toArray();
        self::logOperationForModel($post, OperationTypes::UPDATED()->getValue(), ['post_data' => $postData]);
    }

    /**
     * Обрабатывает событие "удаления" модели Post.
     * Перед удалением сохраняет данные поста и связанных моделей, а затем отвязывает все связанные данные.
     *
     * @param Post $post
     */
    public function deleting(Post $post): void
    {
        logger()->info('PostObserver: deleting event');

        // Сохраняем данные поста и связанных моделей перед удалением
        $postData = $post->toArray();
        $postData['likes'] = $post->likes->toArray();
        $postData['comments'] = $post->comments->toArray();
        $postData['tags'] = $post->tags->toArray();
        $postData['categories'] = $post->categories->toArray();

        self::logOperationForModel($post, OperationTypes::DELETING()->getValue(), ['post_data' => $postData]);

        // Удаление всех связанных данных
        $post->likes()->detach();
        $post->comments()->detach();
        $post->tags()->detach();
        $post->categories()->detach();
    }

    /**
     * Обрабатывает событие "удаления" модели Post.
     *
     * @param Post $post
     */
    public function deleted(Post $post): void
    {
        logger()->info('PostObserver: deleted event');
        self::logOperationForModel($post, OperationTypes::DELETED()->getValue());
    }

    /**
     * Обрабатывает событие "восстановления" модели Post.
     *
     * @param Post $post
     */
    public function restored(Post $post): void
    {
        logger()->info('PostObserver: restored event');
        self::logOperationForModel($post, OperationTypes::RESTORED()->getValue());
    }

    /**
     * Обрабатывает событие "полного удаления" модели Post.
     *
     * @param Post $post
     */
    public function forceDeleted(Post $post): void
    {
        logger()->info('PostObserver: forceDeleted event');
        self::logOperationForModel($post, OperationTypes::FORCE_DELETED()->getValue());
    }
}
