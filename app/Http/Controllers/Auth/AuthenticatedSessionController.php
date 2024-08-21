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
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
        ]);

        $profile = $request->input('profile_id');



        session(['selected_profile' => $profile]);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
