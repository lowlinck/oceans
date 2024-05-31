<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Observers\PostObserver;
use App\Traits\LogsModelEvents;
use App\Enums\OperationTypes;
use Illuminate\Support\Facades\Event;

class PostObserverTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Регистрируем PostObserver
        Post::observe(PostObserver::class);
    }

    public function testPostCreatedLogsOperation()
    {
        // Mock для LogsModelEvents
        $mock = \Mockery::mock('alias:' . LogsModelEvents::class);
        $mock->shouldReceive('logOperationForModel')
            ->once()
            ->with(\Mockery::type(Post::class), OperationTypes::CREATED);

        // Создаем пост
        Post::factory()->create();
    }

    public function testPostUpdatedLogsOperation()
    {
        // Mock для LogsModelEvents
        $mock = \Mockery::mock('alias:' . LogsModelEvents::class);
        $mock->shouldReceive('logOperationForModel')
            ->once()
            ->with(\Mockery::type(Post::class), OperationTypes::UPDATED);

        // Создаем и обновляем пост
        $post = Post::factory()->create();
        $post->title = 'Updated Title';
        $post->save();
    }

    public function testPostDeletedLogsOperation()
    {
        // Mock для LogsModelEvents
        $mock = \Mockery::mock('alias:' . LogsModelEvents::class);
        $mock->shouldReceive('logOperationForModel')
            ->twice()
            ->with(\Mockery::type(Post::class), OperationTypes::DELETED);

        // Создаем и удаляем пост
        $post = Post::factory()->create();
        $post->delete();
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }
}
