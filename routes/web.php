<?php

use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\Profile\ProfileController::class, 'dashboard'])->name('dashboard');
//});

// Подключаем файл маршрутов для аутентификации
require __DIR__.'/auth.php';

// Подключаем файл маршрутов для администратора
require __DIR__.'/admin.php';
