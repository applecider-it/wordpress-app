<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');

Route::get('/page', [PageController::class, 'index'])->name('page.index');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
