<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

//post view
Route::get('/', [PostController::class, 'index'])->name('posts.index');
//post create
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->middleware('auth')->name('posts.store');
Route::resource('posts', PostController::class)->middleware('auth')->except(['index', 'show']);
//comment show + post
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
//comment delete
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');
//comment edit + update
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit')->middleware('auth');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Like機能
    Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
    Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.unlike');
});

require __DIR__.'/auth.php';
