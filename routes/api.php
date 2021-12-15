<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UsCommentController;
use App\Http\Controllers\User\UsPostController;
use App\Http\Controllers\APIController;

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

// Route::get('/{post}/comments', [UsCommentController::class, 'apiIndex'])->name('api.comments.index');
Route::get('/{post}/comments', [APIController::class, 'apiIndex'])->name('api.comments.index');

// Route::post('/comments', [UsCommentController::class, 'apiStore'])->name('api.comments.store');
Route::post('/comments', [APIController::class, 'apiStore'])->name('api.comments.store');
