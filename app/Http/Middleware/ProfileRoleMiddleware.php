<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use PhpParser\Node\Stmt\If_;

class ProfileRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Получаем текущего аутентифицированного пользователя
        $user = Auth::user();

        // Получаем ID текущего профиля из сессии
        $profileId = session('selected_profile');

        if (!$profileId) {
            // Если профиль не выбран, возвращаем 403 (доступ запрещен)
            abort(403, 'Profile not selected.');
        }

        // Получаем профиль пользователя
        $profile = $user->profiles()->find($profileId);

        if (!$profile) {
            // Если профиль не найден, возвращаем 403
            abort(403, 'Profile not found.');
        }

        // Проверяем, есть ли у профиля указанная роль
        if (!$profile->hasRole($role)) {
            // Если роль не найдена, возвращаем 403
            abort(403, 'User does not have the right roles.');
        }

            if($role){
                Inertia::share('role', $role);
            }
        // Если все в порядке, продолжаем выполнение запроса
        return $next($request);
    }
}
