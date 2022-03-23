<?php

use App\Http\Controllers\PostController;
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
    return view('welcome');
});

Route::get('/home', function() {
    return view('components.home');
})->name('home');

Route::get('/settings', function () {
    return view('components.settings');
})->name('settings');

Route::get('/account/{id}', function ($id) {
    return view('components.account', ['account'=>User::find($id)->account]);
})->name('account');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');

require __DIR__.'/auth.php';
