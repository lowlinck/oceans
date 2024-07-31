<?php
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\Profile\ProfileController::class, 'dashboard'])->name('dashboard');
});

// Маршруты, доступные только администраторам
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/posts', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.posts.index');
    Route::post('/posts', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('admin.posts.create');
    Route::get('/posts/{post}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('admin.posts.show');
    Route::patch('/posts/{post}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('admin.posts.update');
    Route::get('/posts/{post}/edit', [App\Http\Controllers\Admin\PostController::class, 'edit'])->name('admin.posts.edit');
    Route::delete('/posts/{post}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('admin.categories.show');
});

// Маршруты для профилей, доступные всем аутентифицированным пользователям
Route::group(['middleware' => ['auth'], 'prefix' => 'profiles'], function () {
    Route::get('/posts', [App\Http\Controllers\Profile\PostProfileController::class, 'index'])->name('profiles.posts.index');
    Route::post('/posts', [App\Http\Controllers\Profile\PostProfileController::class, 'store'])->name('profiles.posts.store');
    Route::get('/posts/create', [App\Http\Controllers\Profile\PostProfileController::class, 'create'])->name('profiles.posts.create');
    Route::get('/posts/{post}', [App\Http\Controllers\Profile\PostProfileController::class, 'show'])->name('profiles.posts.show');
    Route::patch('/posts/{post}', [App\Http\Controllers\Profile\PostProfileController::class, 'update'])->name('profiles.posts.update');
    Route::get('/posts/{post}/edit', [App\Http\Controllers\Profile\PostProfileController::class, 'edit'])->name('profiles.posts.edit');
    Route::delete('/posts/{post}', [App\Http\Controllers\Profile\PostProfileController::class, 'destroy'])->name('profiles.posts.destroy');
//    Route::get('/categories', [App\Http\Controllers\Profile\CategoryController::class, 'index'])->name('profiles.categories.index');
//    Route::get('/categories/create', [App\Http\Controllers\Profile\CategoryController::class, 'show'])->name('profiles.categories.show');
});

require __DIR__.'/auth.php';
