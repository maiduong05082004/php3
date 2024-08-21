<?php

use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\AuthController as UserAuthController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductVariantController;
use App\Http\Controllers\Admin\ProductVariantImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\AuthController;
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
Route::get('/product_detail/{id}', [HomeController::class, 'productDetail'])->name('product_detail');
Route::get('/category', [HomeController::class, 'category']);
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/blog_detail', [HomeController::class, 'blogDetail']);
Route::get('/terms_conditions', [HomeController::class, 'termsConditions']);
Route::get('/my_wishlist', [HomeController::class, 'myWishlist']);
Route::get('/contract', [HomeController::class, 'contract']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/sign_in', [UserAuthController::class, 'index']);
Route::get('/404', [HomeController::class, 'NotFound']);


Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register']);

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/404', [DashboardController::class, 'NotFound'])->name('404');
        Route::resource('coupons', CouponController::class);
        Route::resource('banners', BannerController::class);

        Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit')->where('id', '[0-9]+');
            Route::put('update/{id}', 'update')->name('update')->where('id', '[0-9]+');
            Route::delete('destroy/{id}', 'destroy')->name('destroy')->where('id', '[0-9]+');
            Route::put('soft_destroy/{id}', 'softDestroy')->name('soft_destroy')->where('id', '[0-9]+');
            Route::get('trash', 'trash')->name('trash');
            Route::put('restore/{id}', 'restore')->name('restore')->where('id', '[0-9]+');
            Route::delete('forceDelete/{id}', 'forceDelete')->name('forceDelete')->where('id', '[0-9]+');
            Route::get('{id}/subcategories', [CategoryController::class, 'subcategories'])->name('subcategories');
        });

        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
            Route::put('update/{id}', [ProductController::class, 'update'])->name('update')->where('id', '[0-9]+');
            Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy')->where('id', '[0-9]+');
            Route::put('soft_destroy/{id}', [ProductController::class,'softDestroy'])->name('soft_destroy')->where('id', '[0-9]+');
            Route::get('trash', [ProductController::class, 'trash'])->name('trash');
            Route::put('{product}/restore', [ProductController::class, 'restore'])->name('restore');
            Route::delete('{product}/forceDelete', [ProductController::class, 'forceDelete'])->name('forceDelete');

            Route::prefix('{productId}/variants')->name('product_variants.')->group(function () {
                Route::get('/', [ProductVariantController::class, 'index'])->name('index');
                Route::get('create', [ProductVariantController::class, 'create'])->name('create');
                Route::post('store', [ProductVariantController::class, 'store'])->name('store');
                Route::get('edit/{id}', [ProductVariantController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
                Route::put('update/{id}', [ProductVariantController::class, 'update'])->name('update')->where('id', '[0-9]+');
                Route::delete('destroy/{id}', [ProductVariantController::class, 'destroy'])->name('destroy')->where('id', '[0-9]+');
                
                Route::prefix('{variantId}/images')->name('product_variant_images.')->group(function () {
                    Route::get('/', [ProductVariantImageController::class, 'index'])->name('index');
                    Route::get('create', [ProductVariantImageController::class, 'create'])->name('create');
                    Route::post('store', [ProductVariantImageController::class, 'store'])->name('store');
                    Route::delete('destroy/{imageId}', [ProductVariantImageController::class, 'destroy'])->name('destroy');
                });
            });
        });

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('store', [UserController::class, 'store'])->name('store');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
            Route::put('update/{id}', [UserController::class, 'update'])->name('update')->where('id', '[0-9]+');
            Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('destroy')->where('id', '[0-9]+');
            Route::put('soft_destroy/{id}', [UserController::class,'softDestroy'])->name('soft_destroy')->where('id', '[0-9]+');
            Route::get('trash', [UserController::class, 'trash'])->name('trash');
            Route::post('restore/{id}', [UserController::class, 'restore'])->name('restore')->where('id', '[0-9]+');
            Route::delete('forceDelete/{id}', [UserController::class, 'forceDelete'])->name('forceDelete')->where('id', '[0-9]+');
        });
    });
});
