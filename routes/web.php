<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'index'])->name('home');

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
