<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('posts', [\App\Http\Controllers\PostController::class, 'index']);
    Route::get('posts/{id}', [\App\Http\Controllers\PostController::class, 'show']);
    Route::post('posts', [\App\Http\Controllers\PostController::class, 'store']);
    Route::put('posts', [\App\Http\Controllers\PostController::class, 'update']);
    Route::delete('posts', [\App\Http\Controllers\PostController::class, 'destroy']);

    Route::post('comments', [\App\Http\Controllers\CommentController::class, 'store']);
});
