<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Web\Product\CategoryController;
use App\Http\Controllers\Web\Product\ProducerController;
use App\Http\Controllers\Web\Product\ProductController;
use App\Http\Controllers\Web\Service\ServiceController;
use App\Http\Controllers\Web\Service\ServiceTypeController;
use App\Http\Middleware\RemovePageOne;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'index'])->name('home');

Route::middleware(RemovePageOne::class)->group(function () {
    Route::resource('products', ProductController::class);
});
Route::resource('categories', CategoryController::class);
Route::resource('producers', ProducerController::class);
Route::resource('services', ServiceController::class);
Route::resource('service-types', ServiceTypeController::class);
