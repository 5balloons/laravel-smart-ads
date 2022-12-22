<?php

use Illuminate\Support\Facades\Route;
use _5balloons\LaravelAdManager\Http\Controllers\LaravelAdManagerController;

Route::get('/laravel-ad-manager', [LaravelAdManagerController::class, 'index']);