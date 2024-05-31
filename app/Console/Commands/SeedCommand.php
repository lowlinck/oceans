<?php

namespace App\Console\Commands;

use App\Services\CategorySeederService;
use App\Services\PostSeederService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * Консольная команда для заполнения базы данных случайными данными.
 */
class SeedCommand extends Command
{
    /**
     * Название и подпись консольной команды.
     *
     * @var string
     */
    protected $signature = 'seed';

    /**
     * Описание консольной команды.
     *
     * @var string
     */
    protected $description = 'Seed the database with random data';

    protected $categorySeederService;
    protected $postSeederService;

    /**
     * Конструктор команды.
     *
     * @param CategorySeederService $categorySeederService
     * @param PostSeederService $postSeederService
     */
    public function __construct(CategorySeederService $categorySeederService, PostSeederService $postSeederService)
    {
        parent::__construct();
        $this->categorySeederService = $categorySeederService;
        $this->postSeederService = $postSeederService;
    }

    /**
     * Выполнение консольной команды.
     */
    public function handle()
    {
        Log::info('Starting database seeding');

        // Вызов сидеров для различных таблиц
        $this->call('db:seed', ['--class' => 'UserSeeder']);
        $this->call('db:seed', ['--class' => 'ProfileSeeder']);
        $this->call('db:seed', ['--class' => 'RoleSeeder']);
        $this->call('db:seed', ['--class' => 'CommentSeeder']);
        $this->call('db:seed', ['--class' => 'CategorySeeder']);
        $this->call('db:seed', ['--class' => 'PostSeeder']);
        $this->call('db:seed', ['--class' => 'TagSeeder']);
        $this->call('db:seed', ['--class' => 'ImageSeeder']);
        $this->call('db:seed', ['--class' => 'FileSeeder']);

        // Вызов дополнительных методов заполнения данных
        $this->categorySeederService->seed();
        $this->postSeederService->seed();

        Log::info('Database seeding completed');
        $this->info('Database seeding completed.');
    }
}
