<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');
