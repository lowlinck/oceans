<?php

namespace App\Observers;

use App\Enums\OperationTypes;
use App\Models\Category;
use App\Traits\LogsModelEvents;

/**
 * Наблюдатель за моделью Category.
 * Обрабатывает события, связанные с моделью Category, и логирует их.
 */
class CategoryObserver
{
    use LogsModelEvents;

    /**
     * Обрабатывает событие "создания" модели Category.
     *
     * @param Category $category
     */
    public function created(Category $category): void
    {
        logger()->info('CategoryObserver: created event');
        self::logOperationForModel($category, OperationTypes::CREATED()->getValue());
    }

    /**
     * Обрабатывает событие "обновления" модели Category.
     *
     * @param Category $category
     */
    public function updated(Category $category): void
    {
        logger()->info('CategoryObserver: updated event');
        $categoryData = $category->toArray();
        self::logOperationForModel($category, OperationTypes::UPDATED()->getValue(), ['category_data' => $categoryData]);
    }

    /**
     * Обрабатывает событие "удаления" модели Category.
     *
     * @param Category $category
     */
    public function deleted(Category $category): void
    {
        logger()->info('CategoryObserver: deleted event');
        self::logOperationForModel($category, OperationTypes::DELETED()->getValue());
    }

    /**
     * Обрабатывает событие "восстановления" модели Category.
     *
     * @param Category $category
     */
    public function restored(Category $category): void
    {
        logger()->info('CategoryObserver: restored event');
        self::logOperationForModel($category, OperationTypes::RESTORED()->getValue());
    }

    /**
     * Обрабатывает событие "полного удаления" модели Category.
     *
     * @param Category $category
     */
    public function forceDeleted(Category $category): void
    {
        logger()->info('CategoryObserver: forceDeleted event');
        self::logOperationForModel($category, OperationTypes::FORCE_DELETED()->getValue());
    }
}
