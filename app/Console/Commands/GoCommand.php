<?php

namespace App\Console\Commands;

use App\Models\File;
use App\Models\Image;
use App\Models\Role;
use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;

/**
 * Команда для тестирования операций создания, обновления, удаления, восстановления и полного удаления на указанных моделях.
 */
class GoCommand extends Command
{
    /**
     * Название и подпись консольной команды.
     *
     * @var string
     */
    protected $signature = 'go {model?} {--force : Force delete the model instead of soft deleting}';

    /**
     * Описание консольной команды.
     *
     * @var string
     */
    protected $description = 'Command for testing create, update, delete, restore and force delete operations on specified models';

    /**
     * Выполнение консольной команды.
     */
    public function handle()
    {
        $modelName = $this->argument('model');
        $forceDelete = $this->option('force');

        $models = [
            'Category' => Category::class,
            'Comment' => Comment::class,
            'File' => File::class,
            'Image' => Image::class,
            'Post' => Post::class,
            'Profile' => Profile::class,
            'Tag' => Tag::class,
            'Role' => Role::class,
            'User' => User::class,
        ];

        if ($modelName) {
            if (array_key_exists($modelName, $models)) {
                $this->testModelOperations($models[$modelName], $forceDelete);
            } else {
                $this->error("Model {$modelName} not found.");
            }
        } else {
            foreach ($models as $model) {
                $this->testModelOperations($model, $forceDelete);
            }
        }
    }

    /**
     * Тестирование операций для указанной модели.
     *
     * @param string $model
     * @param bool $forceDelete
     */
    protected function testModelOperations($model, $forceDelete)
    {
        // Создание
        $newInstance = $model::factory()->create();
        $this->info("Created new instance of " . (new $model)->getTable());

        // Обновление
        $factoryInstance = $model::factory()->make();
        $updateData = $factoryInstance->toArray();
        $newInstance->update($updateData);
        $this->info("Updated instance of " . (new $model)->getTable());

        // Удаление или полное удаление
        if ($forceDelete) {
            $newInstance->forceDelete();
            $this->info("Force deleted instance of " . (new $model)->getTable());
        } else {
            $newInstance->delete();
            $this->info("Deleted instance of " . (new $model)->getTable());
        }

        // Восстановление
        if (method_exists($model, 'restore') && !$forceDelete) {
            // Найти любую ранее удалённую запись
            $trashedInstance = $model::onlyTrashed()->first();

            if ($trashedInstance) {
                // Восстановить найденную запись
                $trashedInstance->restore();
                $this->info("Restored instance of " . (new $model)->getTable() . " with ID " . $trashedInstance->id);
                logger()->info('Model restored', ['model' => $model, 'id' => $trashedInstance->id]);
            } else {
                $this->error("No trashed instances found for model " . $model);
            }
        }
    }
}
