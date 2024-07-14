<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Subtitle\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//
//Route::post('login', [AuthController::class, 'login']);
//Route::group(['middleware' => 'jwt.auth'], function () {
//
//    Route::post('logout', [AuthController::class, 'logout']);
//    Route::post('refresh', [AuthController::class, 'refresh']);
//    Route::post('me', [AuthController::class, 'me'] );
//});
//Route::apiResource('posts', PostController::class)->middleware('jwt.auth');
//Route::apiResource('comments', CommentController::class);
//Route::apiResource('tags', TagController::class);
//Route::apiResource('categories', CategoryController::class);
Route::middleware('api')->post('/data', [ApiController::class, 'store']);
