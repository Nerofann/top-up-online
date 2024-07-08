<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admins\AdminDashboardController;
use App\Http\Controllers\Admins\AdminProductController;
use App\Http\Controllers\Admins\AdminProviderController;
use App\Http\Controllers\Admins\KategoryController;
use App\Http\Controllers\Admins\VendorController;
use App\Http\Controllers\OauthGoogleController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'do_login'])->name('loginPost');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'do_register'])->name('registerPost');

    Route::get("/oauth/google", [OauthGoogleController::class, 'index']);
    Route::get("/oauth/google/callback", [OauthGoogleController::class, 'handleProviderCallback']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::prefix('/kategory')->group(function() {
        Route::get('/', [KategoryController::class, 'index'])->name('adminKategory');
        Route::get('/data', [KategoryController::class, 'data']);
        Route::post('/add', [KategoryController::class, 'store']);
        Route::get('/edit/{md5Id}', [KategoryController::class, 'edit']);
        Route::post('/update', [KategoryController::class, 'update']);
        Route::post('/delete/{md5Id}', [KategoryController::class, 'delete']);
    });

    Route::prefix('/provider')->group(function() {
        Route::get('/', [AdminProviderController::class, 'index'])->name('adminProviders');
        Route::get('/data', [AdminProviderController::class, 'data']);
        Route::get('/add', [AdminProviderController::class, 'create']);
        Route::post('/store', [AdminProviderController::class, 'store'])->name('adminProvider_post');
        Route::get('/edit/{code}', [AdminProviderController::class, 'edit']);
        Route::post('/update/{slug}', [AdminProviderController::class, 'update'])->name('adminProviderUpdate_post');
        Route::post('/delete/{slug}', [AdminProviderController::class, 'delete'])->name('adminProviderDelete_post');

        Route::post('/addServer', [AdminProviderController::class, 'addServer']);
    });

    Route::prefix('/vendor')->group(function() {
        Route::get('/data', [VendorController::class, 'data']); 
        Route::get('/add', [VendorController::class, 'index'])->name('AddNewVendor');
        Route::post('/add', [VendorController::class, 'store']);
        Route::get('/{slug}', [VendorController::class, 'edit'])->name('editVendor');
        Route::post('/update/{slug}', [VendorController::class, 'update']);
        Route::post('/delete/{slug}', [VendorController::class, 'delete']);
    });

    Route::prefix('/product')->group(function() {
        Route::get('/', [AdminProductController::class, 'index'])->name('adminProducts');
        Route::get('/list', [AdminProductController::class, 'getListProduct']);
        Route::get('/add', [AdminProductController::class, 'create']);
        Route::post('/add', [AdminProductController::class, 'store']);
    });

    Route::prefix('/payment')->group(function() {
        Route::get('/', [AdminProductController::class, 'index'])->name('paymentList');
    });
});