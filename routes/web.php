<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductVariantController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('/', HomeController::class);
Route::get('/product_detail', [HomeController::class, 'productDetail']);
Route::get('/category', [HomeController::class, 'category']);
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/blog_detail', [HomeController::class, 'blogDetail']);
Route::get('/terms_conditions', [HomeController::class, 'termsConditions']);
Route::get('/my_wishlist', [HomeController::class, 'myWishlist']);
Route::get('/contract', [HomeController::class, 'contract']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/sign_in', [AuthController::class, 'index']);
Route::get('/404', [HomeController::class, 'NotFound']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/404', [DashboardController::class, 'NotFound'])->name('404');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit')->where('id', '[0-9]+');
        Route::put('update/{id}', 'update')->name('update')->where('id', '[0-9]+');
        Route::delete('destroy/{id}', 'destroy')->name('destroy')->where('id', '[0-9]+');
        Route::put('soft_destroy/{id}', 'softDestroy')->name('soft_destroy')->where('id', '[0-9]+');
        Route::get('trash', 'trash')->name('trash');
        Route::post('restore/{id}', 'restore')->name('restore')->where('id', '[0-9]+');
        Route::delete('forceDelete/{id}', 'forceDelete')->name('forceDelete')->where('id', '[0-9]+');
    });
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
        Route::put('update/{id}', [ProductController::class, 'update'])->name('update')->where('id', '[0-9]+');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy')->where('id', '[0-9]+');
        Route::put('products/{product}/trash', [ProductController::class, 'trash'])->name('products.trash');
        Route::put('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
        Route::delete('products/{product}/forceDelete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');

        Route::prefix('{productId}/variants')->name('product_variants.')->group(function () {
            Route::get('/', [ProductVariantController::class, 'index'])->name('index');
            Route::get('create', [ProductVariantController::class, 'create'])->name('create');
            Route::post('store', [ProductVariantController::class, 'store'])->name('store');
            Route::get('edit/{id}', [ProductVariantController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
            Route::put('update/{id}', [ProductVariantController::class, 'update'])->name('update')->where('id', '[0-9]+');
            Route::delete('destroy/{id}', [ProductVariantController::class, 'destroy'])->name('destroy')->where('id', '[0-9]+');
        });
    });
});
