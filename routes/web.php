<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('home'); });

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index')->middleware(['auth', 'admin']);

Route::get('/users/create', [PostController::class, 'create'])
    ->name('users.create');

Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show')->middleware(['auth']);

Route::get('/users/{user}/profile', [ProfileController::class, 'show'])
->name('profiles.show')->middleware(['auth']);

Route::get('/profile/edit', [ProfileController::class, 'edit'])
->name('profiles.edit')->middleware(['auth']);

Route::post('/profile/update', [ProfileController::class, 'update'])
->name('profiles.update')->middleware(['auth']);

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])
    ->name('posts.create')->middleware(['auth']);

Route::post('/posts', [PostController::class, 'store'])
    ->name('posts.store')->middleware(['auth']);

Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show')->middleware(['auth']);

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
    ->name('posts.edit')->middleware(['auth']);

Route::put('/posts/{post}', [PostController::class, 'update'])
    ->name('posts.update')->middleware(['auth']);

Route::delete('/posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.destroy')->middleware(['auth']);


Route::get('/comments', [CommentController::class, 'index'])
    ->name('comments.index')->middleware(['auth']);

Route::get('/comments/{comment}', [CommentController::class, 'show'])
    ->name('comments.show')->middleware(['auth']);

Route::post('/comments', [CommentController::class, 'store'])
    ->name('comments.store')->middleware(['auth']);

Route::put('/comments/{comment}', [CommentController::class, 'update'])
    ->name('comments.update')->middleware(['auth']);

Route::post('/notifications/mark-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return response()->noContent();
})->name('notifications.markAsRead')->middleware('auth');


Route::get('/register', [AuthController::class, 'showRegisterForm'])
->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])
->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
->name('logout')->middleware('auth');

