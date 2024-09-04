<?php

use App\Http\Controllers\Admin\AdminProfilePostController;
use App\Http\Controllers\Admin\CategoryPostsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlockController;

use Illuminate\Support\Facades\Route;



Route::middleware(['auth','profile.role:admin'] )->prefix('admin')->group(function () {

    Route::get('/posts', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.posts.index');
    Route::post('/posts', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('admin.posts.create');
    Route::get('/posts/{post}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('admin.posts.show');
    Route::patch('/posts/{post}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('admin.posts.update');
    Route::get('/posts/{post}/edit', [App\Http\Controllers\Admin\PostController::class, 'edit'])->name('admin.posts.edit');
    Route::delete('/posts/{post}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('/users', [UserController::class,'index'])->name('admin.users.index');
    Route::patch('/posts/{type}/{id}/toggle-block', [BlockController::class, 'toggleBlock'])->name('admin.toggleBlock');


    Route::get('profile/posts/{profile_id}', [AdminProfilePostController::class, 'getPosts'])->name('admin.profile.posts');
    Route::get('category/posts/{category_id}', [CategoryPostsController::class, 'getPosts'])->name('admin.category.posts');
    Route::get('profile/posts/create', [AdminProfilePostController::class, 'create'])->name('profiles.posts.create');
    Route::get('profile/posts/show', [AdminProfilePostController::class, 'show'])->name('profiles.posts.show');
    Route::patch('profile/posts/{profile_id}', [RoleController::class, 'update'])->name('admin.profile.updaterole');

});
