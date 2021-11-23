<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/users', 'UserController@index');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware(['auth']);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware(['auth']);
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware(['auth']);
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show')->middleware(['auth']);

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index')->middleware(['auth']);
Route::get('/comments/create', [commentController::class, 'create'])->name('comments.create')->middleware(['auth']);
Route::post('/comments', [commentController::class, 'store'])->name('comments.store')->middleware(['auth']);
Route::get('/comments/{id}', [commentController::class, 'show'])->name('comments.show')->middleware(['auth']);


require __DIR__.'/auth.php';
