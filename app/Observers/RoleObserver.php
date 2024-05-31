<?php

namespace App\Observers;

use App\Enums\OperationTypes;
use App\Models\Role;
use App\Traits\LogsModelEvents;

/**
 * Наблюдатель за моделью Role.
 * Обрабатывает события, связанные с моделью Role, и логирует их.
 */
class RoleObserver
{
    use LogsModelEvents;

    /**
     * Обрабатывает событие "создания" модели Role.
     *
     * @param Role $role
     */
    public function created(Role $role): void
    {
        self::logOperationForModel($role, OperationTypes::CREATED()->getValue());
    }

    /**
     * Обрабатывает событие "обновления" модели Role.
     *
     * @param Role $role
     */
    public function updated(Role $role): void
    {
        $roleData = $role->toArray();
        self::logOperationForModel($role, OperationTypes::UPDATED()->getValue(), ['role_data' => $roleData]);
    }

    /**
     * Обрабатывает событие "удаления" модели Role.
     *
     * @param Role $role
     */
    public function deleted(Role $role): void
    {
        self::logOperationForModel($role, OperationTypes::DELETED()->getValue());
    }

    /**
     * Обрабатывает событие "восстановления" модели Role.
     *
     * @param Role $role
     */
    public function restored(Role $role): void
    {
        self::logOperationForModel($role, OperationTypes::RESTORED()->getValue());
    }

    /**
     * Обрабатывает событие "полного удаления" модели Role.
     *
     * @param Role $role
     */
    public function forceDeleted(Role $role): void
    {
        self::logOperationForModel($role, OperationTypes::FORCE_DELETED()->getValue());
    }
}
