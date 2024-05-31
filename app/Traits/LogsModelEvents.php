<?php
namespace App\Traits;

use App\Models\ModelLog;
use App\Enums\OperationTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use ReflectionClass;
use App\Events\LogStarted;
use App\Events\LogEnded;

/**
 * Трейт для логирования событий моделей.
 */
trait LogsModelEvents
{
    /**
     * Метод, запускающийся при загрузке трейта.
     * Регистрирует события для логирования операций над моделями.
     */
    protected static function bootLogsModelEvents()
    {
        logger()->info('Booting LogsModelEvents trait');

        // Получаем все константы класса OperationTypes
        $operations = (new ReflectionClass(OperationTypes::class))->getConstants();
        foreach ($operations as $operation) {
            $operationValue = (new OperationTypes($operation))->getValue();
            // Регистрируем событие для каждой операции
            static::registerModelEvent(strtolower($operationValue), function (Model $model) use ($operationValue) {
                if (get_class($model) !== ModelLog::class) {
                    logger()->info("Calling logOperationForModel from bootLogsModelEvents for operation: $operationValue");
                    self::logOperationForModel($model, $operationValue);
                }
            });
        }
    }

    /**
     * Метод для логирования операции над моделью.
     * @param Model $model - модель.
     * @param string $operation - операция.
     * @param array $additionalData - дополнительные данные.
     */
    public static function logOperationForModel(Model $model, string $operation, array $additionalData = [])
    {
        logger()->info("Entering logOperationForModel for operation: $operation on model: " . get_class($model));

        // Отправляем событие начала логирования
        Event::dispatch(new LogStarted($model, $operation));

        // Подготавливаем данные для логирования
        [$oldData, $newData] = self::prepareLogData($model, $operation, $additionalData);

        // Создаем запись в логе
        ModelLog::log(get_class($model), $model->getKey(), $operation, ['old' => $oldData, 'new' => $newData]);
        echo "Log entry created\n";

        // Отправляем событие окончания логирования
        Event::dispatch(new LogEnded($model, $operation));
    }

    /**
     * Метод для подготовки данных для логирования.
     * @param Model $model - модель.
     * @param string $operation - операция.
     * @param array $additionalData - дополнительные данные.
     * @return array - массив с данными до и после операции.
     */
    private static function prepareLogData(Model $model, string $operation, array $additionalData = []): array
    {
        $oldData = null;
        $newData = null;

        // Определяем данные в зависимости от типа операции
        if ($operation === OperationTypes::UPDATED()->getValue()) {
            $oldData = $model->getOriginal();
            $newData = $model->getAttributes();
        } elseif ($operation === OperationTypes::DELETED()->getValue() || $operation === 'deleting post with relations') {
            $oldData = array_merge($model->getAttributes(), $additionalData);
        } else {
            $newData = $model->getAttributes();
        }

        return [$oldData, $newData];
    }
}
