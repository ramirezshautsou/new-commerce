<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\Product\CategoryController;
use App\Http\Controllers\Web\Product\ProducerController;
use App\Http\Controllers\Web\Product\ProductController;
use App\Http\Controllers\Web\Service\ServiceController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\RemovePageOne;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('registration', [AuthController::class, 'showRegistrationForm'])->name('registration');
    Route::post('registration', [AuthController::class, 'registration']);
});

Route::middleware([Authenticate::class])->group(function () {
    Route::middleware(RemovePageOne::class)->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('services', ServiceController::class);
    });

    Route::resource('categories', CategoryController::class);
    Route::resource('producers', ProducerController::class);

    Route::middleware([CheckRole::class])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    });
});


