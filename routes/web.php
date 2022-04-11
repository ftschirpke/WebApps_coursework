<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
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

Route::middleware('throttle:30')->group(function() {
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
    })->middleware('auth')->name('dashboard');
    
    Route::get('/posts', [PostController::class, 'index'])
        ->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])
        ->name('posts.create')->middleware('auth');
    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store')->middleware('auth');
    Route::get('/posts/{post}', [PostController::class, 'show'])
        ->name('posts.show');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('posts.edit')->middleware(['auth', 'can:update,post']);
    Route::put('/posts/{post}/update', [PostController::class, 'update'])
        ->name('posts.update')->middleware(['auth', 'can:update,post']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy')->middleware(['auth', 'can:delete,post']);
        
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])
        ->name('comments.edit')->middleware(['auth', 'can:update,comment']);
    Route::put('/comments/{comment}/update', [CommentController::class, 'update'])
        ->name('comments.update')->middleware(['auth', 'can:update,comment']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy')->middleware(['auth', 'can:delete,comment']);
        
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index')->middleware(['auth', 'can:viewAny,App\Models\Report']);
    Route::post('/reports', [ReportController::class, 'store'])
        ->name('reports.store')->middleware('auth');
    Route::get('/reports/{report}', [ReportController::class, 'show'])
        ->name('reports.show')->middleware(['auth', 'can:view,report']);

    
    Route::get('/cod', [AccountController::class, 'cod'])
        ->name('cod');
    Route::get('/lol', [AccountController::class, 'lol'])
        ->name('lol');
});

require __DIR__.'/auth.php';
