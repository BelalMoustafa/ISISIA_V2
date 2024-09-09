<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AdminsController;
use App\Http\Controllers\client\UserController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\category\CategoryController;
use App\Http\Controllers\OrderController;

// Main Routes
Route::get('/', [UserController::class, 'main'])->name('main');
Route::get('about', [UserController::class, 'about'])->name('about');
Route::get('contact', [UserController::class, 'contact'])->name('contact');

// Authentication Routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authLogin'])->name('auth_login');
Route::get('logout', [AuthController::class, 'authLogout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'storeUser'])->name('register.store');

// Forgot password routes
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('forgot-password', [AuthController::class, 'sendResetCode'])->name('password.sendCode');
Route::get('verify-code', [AuthController::class, 'showVerifyCodeForm'])->name('password.verifyCodeForm');
Route::post('verify-code', [AuthController::class, 'verifyResetCode'])->name('password.verifyCode');
Route::get('reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.resetForm');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');


Route::group(['middleware' => 'admin'], function () {
    // Dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Admins Routes,Admin Routes Protected by admin middleware
    Route::prefix('admin/admins')->group(function () {
        Route::get('/', [AdminsController::class, 'admins'])->name('admins');
        Route::get('add', [AdminsController::class, 'addAdmin'])->name('add');
        Route::post('add', [AdminsController::class, 'storeAdmin'])->name('store');
        Route::get('edit/{id}', [AdminsController::class, 'editAdmin'])->name('edit');
        Route::post('edit/{id}', [AdminsController::class, 'updateAdmin'])->name('update');
        Route::delete('delete/{id}', [AdminsController::class, 'deleteAdmin'])->name('delete');
    });

    // Categories Routes
    Route::prefix('admin/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'categories'])->name('categories');
        Route::get('add', [CategoryController::class, 'addCategory'])->name('addCategory');
        Route::post('add', [CategoryController::class, 'storeCategory'])->name('storeCategory');
        Route::get('show/{id}', [CategoryController::class, 'showCategory'])->name('showCategory');
        Route::get('edit/{id}', [CategoryController::class, 'editCategory'])->name('editCategory');
        Route::post('edit/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory');
        Route::delete('delete/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    });

        // Products Routes
    Route::prefix('admin/products')->group(function () {
        Route::get('/', [ProductController::class, 'products'])->name('products');
        Route::get('add', [ProductController::class, 'addProduct'])->name('addProduct');
        Route::post('add', [ProductController::class, 'storeProduct'])->name('storeProduct');
        Route::get('show/{id}', [ProductController::class, 'showProduct'])->name('showProduct');
        Route::get('edit/{id}', [ProductController::class, 'editProduct'])->name('editProduct');
        Route::post('edit/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
        Route::delete('delete/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
    });

    // Orders Routes
    Route::prefix('admin/orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::patch('/update-status/{id}', [OrderController::class, 'updateStatus'])->name('updateStatus');
    });
});

// Client Routes, Client Routes Protected by user middleware
Route::group(['middleware' => 'user'],function () {
    Route::get('/shop', [UserController::class, 'shop'])->name('shop');
    Route::get('/product/{id}', [UserController::class, 'productDetail'])->name('product.detail');
    Route::get('/cart', [UserController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/update', [UserController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/add', [UserController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [UserController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/checkout', [UserController::class, 'checkout'])->name('cart.checkout');
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist.view');
    Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
});
// 404 Not Found Page
Route::fallback(function () {
    return response()->view('notFound', [], 404);
});
