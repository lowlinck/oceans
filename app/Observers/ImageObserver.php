<?php

namespace App\Observers;

use App\Enums\OperationTypes;
use App\Models\Image;
use App\Traits\LogsModelEvents;

/**
 * Наблюдатель за моделью Image.
 * Обрабатывает события, связанные с моделью Image, и логирует их.
 */
class ImageObserver
{
    use LogsModelEvents;

    /**
     * Обрабатывает событие "создания" модели Image.
     *
     * @param Image $image
     */
    public function created(Image $image): void
    {
        logger()->info('ImageObserver: created event');
        self::logOperationForModel($image, OperationTypes::CREATED()->getValue());
    }

    /**
     * Обрабатывает событие "обновления" модели Image.
     *
     * @param Image $image
     */
    public function updated(Image $image): void
    {
        logger()->info('ImageObserver: updated event');
        $imageData = $image->toArray();
        self::logOperationForModel($image, OperationTypes::UPDATED()->getValue(), ['image_data' => $imageData]);
    }

    /**
     * Обрабатывает событие "удаления" модели Image.
     *
     * @param Image $image
     */
    public function deleted(Image $image): void
    {
        logger()->info('ImageObserver: deleted event');
        self::logOperationForModel($image, OperationTypes::DELETED()->getValue());
    }

    /**
     * Обрабатывает событие "восстановления" модели Image.
     *
     * @param Image $image
     */
    public function restored(Image $image): void
    {
        logger()->info('ImageObserver: restored event');
        self::logOperationForModel($image, OperationTypes::RESTORED()->getValue());
    }

    /**
     * Обрабатывает событие "полного удаления" модели Image.
     *
     * @param Image $image
     */
    public function forceDeleted(Image $image): void
    {
        logger()->info('ImageObserver: forceDeleted event');
        self::logOperationForModel($image, OperationTypes::FORCE_DELETED()->getValue());
    }
}
