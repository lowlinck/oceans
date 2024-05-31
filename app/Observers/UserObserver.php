<?php
namespace App\Observers;

use App\Enums\OperationTypes;
use App\Models\User;
use App\Traits\LogsModelEvents;
use Faker\Factory as Faker;

class UserObserver
{
    use LogsModelEvents;

    public function created(User $user): void
    {
        logger()->info('UserObserver: created event');
        $faker = Faker::create();

        $user->profiles()->create([
            'user_id' => $user->id,
            'first_name' => $faker->firstName(),
            'second_name' => $faker->firstNameMale(),
            'is_married' => $faker->boolean(),
            'birthed_at' => $faker->dateTimeBetween('-30 years', 'now'),
            'gender' => $faker->randomElement(['male', 'female']),
            'age' => $faker->numberBetween(20, 70),
        ]);

        self::logOperationForModel($user, OperationTypes::CREATED()->getValue());
    }

    public function updated(User $user): void
    {
        logger()->info('UserObserver: updated event');
        self::logOperationForModel($user, OperationTypes::UPDATED()->getValue());
    }

    public function restoring(User $user): void
    {
        logger()->info('UserObserver: restoring event');
        // Восстановление всех связанных данных
        foreach ($user->profiles()->withTrashed()->get() as $profile) {
            $profile->restore();

            foreach ($profile->posts()->withTrashed()->get() as $post) {
                $post->restore();
            }

            foreach ($profile->comments()->withTrashed()->get() as $comment) {
                $comment->restore();
            }

            $profile->likes()->restore();
            $profile->roles()->restore();
        }
        self::logOperationForModel($user, OperationTypes::RESTORING()->getValue());
    }

    public function deleting(User $user): void
    {
        logger()->info('UserObserver: deleting event');
        // Удаление всех связанных данных
        foreach ($user->profiles as $profile) {
            foreach ($profile->posts as $post) {
                $post->likes()->detach();
                $post->comments()->detach();
                $post->tags()->detach();
                $post->categories()->detach();
                $post->delete();
            }

            foreach ($profile->comments as $comment) {
                $comment->posts()->detach();
                $comment->categories()->detach();
                $comment->delete();
            }

            $profile->likes()->detach();
            $profile->roles()->delete();
            $profile->delete();
        }

        self::logOperationForModel($user, OperationTypes::DELETING()->getValue());
    }

    public function deleted(User $user): void
    {
        logger()->info('UserObserver: deleted event');
        self::logOperationForModel($user, OperationTypes::DELETED()->getValue());
    }

    public function restored(User $user): void
    {
        logger()->info('UserObserver: restored event');
        self::logOperationForModel($user, OperationTypes::RESTORED()->getValue());
    }

    public function forceDeleted(User $user): void
    {
        logger()->info('UserObserver: forceDeleted event');
        self::logOperationForModel($user, OperationTypes::FORCE_DELETED()->getValue());
    }

    public function forceDeleting(User $user): void
    {
        logger()->info('UserObserver: forceDeleting event');
        // Удаление всех связанных данных
        foreach ($user->profiles()->withTrashed()->get() as $profile) {
            foreach ($profile->posts()->withTrashed()->get() as $post) {
                $post->forceDelete();
            }

            foreach ($profile->comments()->withTrashed()->get() as $comment) {
                $comment->forceDelete();
            }

            $profile->forceDelete();
        }
    }
}
