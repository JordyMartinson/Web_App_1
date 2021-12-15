<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UsCommentController;
use App\Http\Controllers\User\UsPostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/comments', [UsCommentController::class, 'apiIndex'])->name('api.comments.index');

Route::post('/comments', [UsCommentController::class, 'apiStore'])->name('api.comments.store');

Route::get('/user/posts', [UsPostController::class, 'apiIndex'])->name('api.posts.index');

Route::post('/user/posts', [UsPostController::class, 'apiStore'])->name('api.posts.store');
