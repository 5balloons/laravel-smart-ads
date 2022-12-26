<?php

use Illuminate\Support\Facades\Route;
use _5balloons\LaravelSmartAds\Http\Controllers\LaravelSmartAdsController;

Route::get('/laravel-smart-ads', [LaravelSmartAdsController::class, 'index']);