<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Получаем все профили пользователя с ролями
            $profiles = $user->profiles()->with('roles')->get();

            // Обрабатываем профили и роли
            $roles = $profiles->flatMap(function ($profile) {
                return $profile->roles->pluck('title');
            });

            // Если ни одна роль не найдена, добавляем "guest"
            if ($roles->isEmpty()) {
                $roles = collect(['guest']);
            } else {
                $roles = $roles->unique()->values();
            }

            // Делаем роли доступными везде через Inertia
            Inertia::share('userRoles', $roles->toArray());
        }

        return $next($request);
    }
}
