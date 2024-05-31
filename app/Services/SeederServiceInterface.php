<?php

namespace App\Services;

/**
 * Интерфейс для сервисов, выполняющих операции по заполнению данных.
 */
interface SeederServiceInterface
{
    /**
     * Метод для выполнения всех операций по заполнению данных.
     */
    public function seed();
}
