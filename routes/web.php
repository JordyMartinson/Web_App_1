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

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('/comments/create', [commentController::class, 'create'])->name('comments.create');
Route::post('/comments', [commentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}', [commentController::class, 'show'])->name('comments.show');


require __DIR__.'/auth.php';
