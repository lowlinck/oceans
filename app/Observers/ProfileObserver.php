<?php

namespace App\Observers;

use App\Enums\OperationTypes;
use App\Models\Profile;
use App\Traits\LogsModelEvents;

/**
 * Наблюдатель за моделью Profile.
 * Обрабатывает события, связанные с моделью Profile, и логирует их.
 */
class ProfileObserver
{
    use LogsModelEvents;

    /**
     * Обрабатывает событие "создания" модели Profile.
     *
     * @param Profile $profile
     */
    public function created(Profile $profile): void
    {
        logger()->info('ProfileObserver: created event');
        self::logOperationForModel($profile, OperationTypes::CREATED()->getValue());
    }

    /**
     * Обрабатывает событие "обновления" модели Profile.
     *
     * @param Profile $profile
     */
    public function updated(Profile $profile): void
    {
        logger()->info('ProfileObserver: updated event');
        $profileData = $profile->toArray();
        self::logOperationForModel($profile, OperationTypes::UPDATED()->getValue(), ['profile_data' => $profileData]);
    }

    /**
     * Обрабатывает событие "удаления" модели Profile.
     *
     * @param Profile $profile
     */
    public function deleted(Profile $profile): void
    {
        logger()->info('ProfileObserver: deleted event');
        self::logOperationForModel($profile, OperationTypes::DELETED()->getValue());
    }

    /**
     * Обрабатывает событие "восстановления" модели Profile.
     *
     * @param Profile $profile
     */
    public function restored(Profile $profile): void
    {
        logger()->info('ProfileObserver: restored event');
        self::logOperationForModel($profile, OperationTypes::RESTORED()->getValue());
    }

    /**
     * Обрабатывает событие "полного удаления" модели Profile.
     *
     * @param Profile $profile
     */
    public function forceDeleted(Profile $profile): void
    {
        logger()->info('ProfileObserver: forceDeleted event');
        self::logOperationForModel($profile, OperationTypes::FORCE_DELETED()->getValue());
    }
}
