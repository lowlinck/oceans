<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Middleware isAdminMiddleware triggered');

        if (Auth::check()) {
            $user = Auth::user();
            Log::info('User is authenticated', ['user_id' => $user->id]);

            // Проверка, если хотя бы один профиль пользователя имеет роль 'admin'
            foreach ($user->profiles as $profile) {
                if ($profile->roles()->where('title', 'admin')->exists()) {
                    Log::info('User is admin', ['user_id' => $user->id]);
                    return $next($request);
                }
            }

            // Если пользователь авторизован, но не администратор
            Log::info('User is not admin', ['user_id' => $user->id]);
            return redirect('/')->with('error', 'You do not have admin access.');
        }

        // Если пользователь не авторизован, перенаправляем его на страницу логина,
        // но убедимся, что мы не создаем бесконечный цикл
        if ($request->is('login') || $request->is('register')) {
            return $next($request);
        }

        Log::info('User is not authenticated');
        return redirect()->route('login');
    }
}
