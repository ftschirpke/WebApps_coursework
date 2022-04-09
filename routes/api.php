<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/api/posts/{post}/{offset?}', [PostController::class, 'apiShow'])
    ->name('api.posts.show');

// Route::middleware('auth:sanctum')->group(function () {
// });

Route::post('/api/comments/store', [CommentController::class, 'apiStore'])
    ->name('api.comments.store');
