<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

require __DIR__ . "/auth/web/auth.php";
require __DIR__ . "/auth/web/admin.php";
require __DIR__ . "/auth/web/dashboard.php";