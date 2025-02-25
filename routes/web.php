<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

// Trang chủ -> Kiểm tra trạng thái đăng nhập và điều hướng phù hợp
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('products.index') // Nếu đã đăng nhập -> Chuyển đến trang sản phẩm
        : redirect()->route('login'); // Nếu chưa đăng nhập -> Chuyển đến trang đăng nhập
})->name('home');

// Các route dành cho khách (chưa đăng nhập)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // Thêm route login
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register'])->name('register.process');
});

// Các route yêu cầu đăng nhập
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
