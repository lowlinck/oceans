<?php

use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'profile.role:admin, user, editor']], function () {

    Route::get('/', [ProfileController::class, 'dashboard'])->name('dashboard');
});

// Подключаем файл маршрутов для аутентификации
require __DIR__.'/auth.php';

// Подключаем файл маршрутов для администратора
require __DIR__.'/admin.php';
