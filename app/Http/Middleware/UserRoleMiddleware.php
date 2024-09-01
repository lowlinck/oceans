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
//        dd(session('selected_role'));
        if (Auth::check()) {
            // Получаем роль из сессии
            $role = session('selected_role'); // Если роли нет, по умолчанию будет "guest"
                     // Делаем роль доступной через Inertia


            Inertia::share('userRole', $role);
        }

        return $next($request);
    }
}
