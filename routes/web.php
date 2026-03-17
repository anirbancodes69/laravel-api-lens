<?php

use Illuminate\Support\Facades\Route;
use ApiLens\Laravel\Http\Controllers\DashboardController;
use ApiLens\Laravel\Middleware\ApiLensAuth;

Route::middleware(ApiLensAuth::class)->group(function () {
    Route::get('/apilens', [DashboardController::class, 'index']);
});