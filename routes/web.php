<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SessionController;

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

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware(['auth']);
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware(['auth']);
Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware(['auth']);
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show')->middleware(['auth']);

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware(['auth']);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware(['auth']);
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware(['auth']);
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show')->middleware(['auth']);

// Route::get('/comments/index', [CommentController::class, 'index'])->name('comments.index')->middleware(['auth']);

Route::get('/comments/create', [commentController::class, 'create'])->name('comments.create')->middleware(['auth']);
Route::post('/comments', [commentController::class, 'store'])->name('comments.store')->middleware(['auth']);
Route::get('/comments/index/{id}', [CommentController::class, 'index'])->name('comments.index')->middleware(['auth'])->where(['id' => '[0-9]+']);
Route::get('/comments/{id}', [commentController::class, 'show'])->name('comments.show')->middleware(['auth']);

Route::post('logout', [SessionController::class], 'destroy');


require __DIR__.'/auth.php';
