<?php

namespace App\Observers;

use App\Enums\OperationTypes;
use App\Models\File;
use App\Traits\LogsModelEvents;

/**
 * Наблюдатель за моделью File.
 * Обрабатывает события, связанные с моделью File, и логирует их.
 */
class FileObserver
{
    use LogsModelEvents;

    /**
     * Обрабатывает событие "создания" модели File.
     *
     * @param File $file
     */
    public function created(File $file): void
    {
        logger()->info('FileObserver: created event');
        self::logOperationForModel($file, OperationTypes::CREATED()->getValue());
    }

    /**
     * Обрабатывает событие "обновления" модели File.
     *
     * @param File $file
     */
    public function updated(File $file): void
    {
        logger()->info('FileObserver: updated event');
        $fileData = $file->toArray();
        self::logOperationForModel($file, OperationTypes::UPDATED()->getValue(), ['file_data' => $fileData]);
    }

    /**
     * Обрабатывает событие "удаления" модели File.
     *
     * @param File $file
     */
    public function deleted(File $file): void
    {
        logger()->info('FileObserver: deleted event');
        self::logOperationForModel($file, OperationTypes::DELETED()->getValue());
    }

    /**
     * Обрабатывает событие "восстановления" модели File.
     *
     * @param File $file
     */
    public function restored(File $file): void
    {
        logger()->info('FileObserver: restored event');
        self::logOperationForModel($file, OperationTypes::RESTORED()->getValue());
    }

    /**
     * Обрабатывает событие "полного удаления" модели File.
     *
     * @param File $file
     */
    public function forceDeleted(File $file): void
    {
        logger()->info('FileObserver: forceDeleted event');
        self::logOperationForModel($file, OperationTypes::FORCE_DELETED()->getValue());
    }
}
