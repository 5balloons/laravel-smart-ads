<?php

use Illuminate\Support\Facades\Route;
use _5balloons\LaravelSmartAds\Http\Controllers\SmartAdManagerController;

Route::group([ 'prefix' => '', 'middleware' => 'web'], function () {
    Route::get('/smart-ad-manager', [SmartAdManagerController::class, 'index']);
    Route::get('/smart-ad-manager/ads/create', [SmartAdManagerController::class, 'create']);
    Route::get('/smart-ad-manager/ads/{smartAd}', [SmartAdManagerController::class, 'show']);
    Route::post('/smart-ad-manager/ads/store', [SmartAdManagerController::class, 'store']);
    Route::get('/smart-ad-manager/ads/edit/{smartAd}', [SmartAdManagerController::class, 'edit']);
    Route::put('/smart-ad-manager/ads/update/{smartAd}', [SmartAdManagerController::class, 'update']);
    Route::delete('/smart-ad-manager/ads/delete/{smartAd}', [SmartAdManagerController::class, 'delete']);
});