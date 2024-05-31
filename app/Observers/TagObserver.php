<?php

namespace App\Observers;

use App\Enums\OperationTypes;
use App\Models\Tag;
use App\Traits\LogsModelEvents;

/**
 * Наблюдатель за моделью Tag.
 * Обрабатывает события, связанные с моделью Tag, и логирует их.
 */
class TagObserver
{
    use LogsModelEvents;

    /**
     * Обрабатывает событие "создания" модели Tag.
     *
     * @param Tag $tag
     */
    public function created(Tag $tag): void
    {
        logger()->info('Entering created method in TagObserver');
        self::logOperationForModel($tag, OperationTypes::CREATED()->getValue());
    }

    /**
     * Обрабатывает событие "обновления" модели Tag.
     *
     * @param Tag $tag
     */
    public function updated(Tag $tag): void
    {
        logger()->info('Entering updated method in TagObserver');
        $tagData = $tag->toArray();
        self::logOperationForModel($tag, OperationTypes::UPDATED()->getValue(), ['tag_data' => $tagData]);
    }

    /**
     * Обрабатывает событие "удаления" модели Tag.
     *
     * @param Tag $tag
     */
    public function deleted(Tag $tag): void
    {
        logger()->info('Entering deleted method in TagObserver');
        self::logOperationForModel($tag, OperationTypes::DELETED()->getValue());
    }

    /**
     * Обрабатывает событие "восстановления" модели Tag.
     *
     * @param Tag $tag
     */
    public function restored(Tag $tag): void
    {
        logger()->info('Entering restored method in TagObserver');
        self::logOperationForModel($tag, OperationTypes::RESTORED()->getValue());
    }

    /**
     * Обрабатывает событие "полного удаления" модели Tag.
     *
     * @param Tag $tag
     */
    public function forceDeleted(Tag $tag): void
    {
        logger()->info('Entering forceDeleted method in TagObserver');
        self::logOperationForModel($tag, OperationTypes::FORCE_DELETED()->getValue());
    }
}
