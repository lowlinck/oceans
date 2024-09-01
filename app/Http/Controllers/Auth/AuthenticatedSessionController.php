<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {

        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        $profiles = $user->profiles; // Предполагается, что у пользователя есть связь profiles

        if ($profiles->count() === 1) {
            // Если у пользователя только один профиль, автоматически выбираем его
            session(['selected_profile' => $profiles->first()->id]);
            return redirect()->intended(route('dashboard'));
        }

        // Возвращаем страницу выбора профиля с профилями пользователя
        return redirect()->route('selectProfile');
    }

    /**
     * Display the profile selection view.
     */
    public function showSelectProfile(): Response
    {
        $user = Auth::user();
        $profiles = $user->profiles; // Предполагается, что у пользователя есть связь profiles

        return Inertia::render('Auth/SelectProfile', [
            'profiles' => $profiles,
        ]);
    }

    /**
     * Handle profile selection.
     */
    public function selectProfile(Request $request): RedirectResponse
    {
        // Валидация запроса
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
        ]);

        // Получаем ID выбранного профиля из запроса
        $profileId = $request->input('profile_id');

        // Сохраняем выбранный профиль в сессии
        session(['selected_profile' => $profileId]);

        // Получаем текущего пользователя
        $user = Auth::user();

        // Находим профиль, принадлежащий пользователю
        $profile = $user->profiles()->where('id', $profileId)->first();

        if (!$profile) {
            return redirect()->back()->withErrors('Профиль не найден.');
        }

        // Получаем первую роль, связанную с профилем (предполагается, что профиль может иметь одну роль)
        $profileRole = $profile->roles->first();

        if (!$profileRole) {
            return redirect()->back()->withErrors('У выбранного профиля нет связанных ролей.');
        }

        // Сохраняем роль профиля в сессии
        session(['selected_role' => $profileRole->name]);

        // Дополнительно сохраняем роль профиля в сессии (если потребуется использовать)
        session()->save();

        return redirect()->route('admin.posts.index')->with('success', 'Профиль и роль успешно выбраны.');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Выход пользователя из системы
        Auth::guard('web')->logout();

        // Аннулирование текущей сессии
        $request->session()->invalidate();

        // Генерация нового CSRF-токена для безопасности
        $request->session()->regenerateToken();

        // Перенаправление на страницу логина
        return redirect()->route('login');
    }
}
