<?php

namespace App\Observers;

use App\Enums\OperationTypes;
use App\Models\Comment;
use App\Traits\LogsModelEvents;

/**
 * Наблюдатель за моделью Comment.
 * Обрабатывает события, связанные с моделью Comment, и логирует их.
 */
class CommentObserver
{
    use LogsModelEvents;

    /**
     * Обрабатывает событие "создания" модели Comment.
     *
     * @param Comment $comment
     */
    public function created(Comment $comment): void
    {
        logger()->info('CommentObserver: created event');
        self::logOperationForModel($comment, OperationTypes::CREATED()->getValue());
    }

    /**
     * Обрабатывает событие "обновления" модели Comment.
     *
     * @param Comment $comment
     */
    public function updated(Comment $comment): void
    {
        logger()->info('CommentObserver: updated event');
        $commentData = $comment->toArray();
        self::logOperationForModel($comment, OperationTypes::UPDATED()->getValue(), ['comment_data' => $commentData]);
    }

    /**
     * Обрабатывает событие "удаления" модели Comment.
     *
     * @param Comment $comment
     */
    public function deleted(Comment $comment): void
    {
        logger()->info('CommentObserver: deleted event');
        self::logOperationForModel($comment, OperationTypes::DELETED()->getValue());
    }

    /**
     * Обрабатывает событие "восстановления" модели Comment.
     *
     * @param Comment $comment
     */
    public function restored(Comment $comment): void
    {
        logger()->info('CommentObserver: restored event');
        self::logOperationForModel($comment, OperationTypes::RESTORED()->getValue());
    }

    /**
     * Обрабатывает событие "полного удаления" модели Comment.
     *
     * @param Comment $comment
     */
    public function forceDeleted(Comment $comment): void
    {
        logger()->info('CommentObserver: forceDeleted event');
        self::logOperationForModel($comment, OperationTypes::FORCE_DELETED()->getValue());
    }
}
