<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasSelectedProfileAndIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Middleware EnsureUserHasSelectedProfileAndIsAdmin triggered');

        if (!Auth::check()) {

            Log::info('User is not authenticated');
            return redirect()->route('login');
        }
        dd(111);
        $user = Auth::user();
        Log::info('User is authenticated', ['user_id' => $user->id]);

// Проверка наличия выбранного профиля, исключая маршруты для выбора профиля
        if (!$request->session()->has('selected_profile') && !$request->routeIs('selectProfile') && !$request->isMethod('post')) {
            Log::info('User has not selected a profile', ['user_id' => $user->id]);
            return redirect()->route('selectProfile');
        }

// Проверка, если хотя бы один профиль пользователя имеет роль 'admin'
        $selectedProfileId = session('selected_profile');
        $selectedProfile = $user->profiles()->find($selectedProfileId);

        if (!$selectedProfile || !$selectedProfile->roles()->where('title', 'admin')->exists()) {
            Log::info('User is not admin or selected profile is invalid', ['user_id' => $user->id]);
            return redirect('/')->with('error', 'You do not have admin access.');
        }

        Log::info('User is admin and has selected a profile', ['user_id' => $user->id, 'profile_id' => $selectedProfileId]);
        return $next($request);
    }
}
