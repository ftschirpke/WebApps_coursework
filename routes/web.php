<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('components.home');
})->name('home');

Route::get('/settings', function () {
    return view('components.settings');
})->name('settings');

Route::get('/account/{account}', [AccountController::class, 'show'])
    ->name('accounts.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])
    ->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])
    ->name('posts.store')->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.destroy')->middleware(['auth']);

require __DIR__.'/auth.php';
