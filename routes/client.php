<?php

use App\Http\Controllers\Profile\PostProfileController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' =>['auth']], function (){
    Route::get('/dashboard', [App\Http\Controllers\Profile\ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/logout', [\App\Http\Controllers\MainController::class, 'logout'])->name('clients.logout');
    Route::group(['prefix'=>'profiles'], function (){
        Route::resource('/posts', PostProfileController::class );
    });
});
