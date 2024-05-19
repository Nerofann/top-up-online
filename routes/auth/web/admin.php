<?php

use App\Http\Controllers\Admins\AdminDashboardController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/a/dashboard', [AdminDashboardController::class, 'index'])->name('admin_dashboard');
});