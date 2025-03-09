<?php

use App\Http\Controllers\App\MenuController;
use App\Http\Controllers\Auth\{CategoryController,
    DashboardController,
    LoginController,
    ProductController,
    RegisterController,};
use Illuminate\Support\Facades\Route;


Route::prefix('cp')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:7,1');
        Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->middleware('throttle:5,1');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/', DashboardController::class)->name('auth.dashboard');

        Route::resources([
            'categories' => CategoryController::class,
            'products' => ProductController::class,
        ]);

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});


Route::get('{username}', [MenuController::class, 'showMenu'])->name('menu.show');
Route::get('{username}/{category_slug}', [MenuController::class, 'showCategory'])->name('category.show');
Route::get('{username}/{category_slug}/{product_slug}', [MenuController::class, 'showProduct'])->name('product.show');
