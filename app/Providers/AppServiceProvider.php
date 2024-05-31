<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\File;
use App\Models\Image;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use App\Observers\CategoryObserver;
use App\Observers\CommentObserver;
use App\Observers\FileObserver;
use App\Observers\ImageObserver;
use App\Observers\PostObserver;
use App\Observers\ProfileObserver;
use App\Observers\RoleObserver;
use App\Observers\TagObserver;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Services\CategorySeederService;
use App\Services\PostSeederService;
use App\Services\SeederServiceInterface;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CategorySeederService::class, function ($app) {
            return new CategorySeederService();
        });

        $this->app->singleton(PostSeederService::class, function ($app) {
            return new PostSeederService();
        });

    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        // Добавление  отладочных сообщений для каждой регистрации
        // из-за проблем дублирования в базе данных
        logger()->info('Registering UserObserver');
        User::observe(UserObserver::class);

        logger()->info('Registering PostObserver');
        Post::observe(PostObserver::class);

        logger()->info('Registering CommentObserver');
        Comment::observe(CommentObserver::class);

        logger()->info('Registering CategoryObserver');
        Category::observe(CategoryObserver::class);

        logger()->info('Registering FileObserver');
        File::observe(FileObserver::class);

        logger()->info('Registering ImageObserver');
        Image::observe(ImageObserver::class);

        logger()->info('Registering ProfileObserver');
        Profile::observe(ProfileObserver::class);

        logger()->info('Registering RoleObserver');
        Role::observe(RoleObserver::class);

        logger()->info('Registering TagObserver');
        Tag::observe(TagObserver::class);


    }
}
