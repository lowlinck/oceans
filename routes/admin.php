<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Middleware\IsAdminMiddleware;




//Route::get('/dashboard/logout', [\App\Http\Controllers\MainController::class, 'logout'])->name('clients.logout');




require __DIR__.'/auth.php';
