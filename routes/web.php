<?php

use Illuminate\Support\Facades\Route;
use Admin\AdUserController;
use Admin\AdPostController;
use Admin\AdCommentController;
use User\UsUserController;
use User\UsPostController;
use User\UsCommentController;

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
    return view('layouts.app');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::get('/admin/posts/index/all', [App\Http\Controllers\Admin\AdPostController::class, 'indexall'])->name('admin.posts.indexall')->middleware('auth');
Route::get('/admin/users/index/all', [App\Http\Controllers\Admin\AdUserController::class, 'indexall'])->name('admin.users.indexall')->middleware('auth');
Route::get('/admin/comments/index/all', [App\Http\Controllers\Admin\AdCommentController::class, 'indexall'])->name('admin.comments.indexall')->middleware('auth');
Route::get('/user/posts/index/all', [App\Http\Controllers\User\UsPostController::class, 'indexall'])->name('user.posts.indexall')->middleware('auth');

Route::get('/comments', [App\Http\Controllers\User\UsCommentController::class, 'index']);
Route::get('/user/posts/{id}', [App\Http\Controllers\User\UsPostController::class, 'show']);

Route::name('admin.')->middleware('auth')->group(function () {
    Route::resource('/admin/users', AdUserController::class);
    Route::resource('/admin/posts', AdPostController::class);
    Route::resource('/admin/comments', AdCommentController::class);
});

Route::name('user.')->middleware('auth')->group(function () {
    Route::resource('/user/users', UsUserController::class);
    Route::resource('/user/posts', UsPostController::class);
    Route::resource('/user/comments', UsCommentController::class);
});


Route::post('logout', [SessionController::class], 'logout');

require __DIR__.'/auth.php';
