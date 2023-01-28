<?php

use Illuminate\Support\Facades\Route;
use _5balloons\LaravelSmartAds\Http\Controllers\SmartAdManagerController;


$prefix = config('smart-ads.route.prefix');
$middleware = config('smart-ads.route.middleware');

Route::group(['prefix' => $prefix, 'middleware' => $middleware], function () {
    Route::get('/smart-ad-manager', [SmartAdManagerController::class, 'dashboard']);
    Route::get('/smart-ad-manager/ads', [SmartAdManagerController::class, 'index']);
    Route::get('/smart-ad-manager/ads/create', [SmartAdManagerController::class, 'create']);
    Route::get('/smart-ad-manager/ads/{smartAd}', [SmartAdManagerController::class, 'show']);
    Route::post('/smart-ad-manager/ads/store', [SmartAdManagerController::class, 'store']);
    Route::get('/smart-ad-manager/ads/edit/{smartAd}', [SmartAdManagerController::class, 'edit']);
    Route::put('/smart-ad-manager/ads/update/{smartAd}', [SmartAdManagerController::class, 'update']);
    Route::delete('/smart-ad-manager/ads/delete/{smartAd}', [SmartAdManagerController::class, 'delete']);
    Route::post('/smart-ad-manager/ads/disable/{smartAd}', [SmartAdManagerController::class, 'disable']);
    Route::post('/smart-ad-manager/ads/enable/{smartAd}', [SmartAdManagerController::class, 'enable']);
});

Route::get('/smart-banner-auto-placements', [SmartAdManagerController::class, 'autoAds']);
Route::post('/smart-banner-update-clicks', [SmartAdManagerController::class, 'updateClicks']);