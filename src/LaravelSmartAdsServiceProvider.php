<?php

namespace _5balloons\LaravelSmartAds;

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use _5balloons\LaravelSmartAds\Components\SmartAdComponent;

class LaravelSmartAdsServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
        ->name('laravel-smart-ads')
        ->hasConfigFile()
        ->hasViews()
        ->hasRoute('web')
        ->hasAssets()
        ->hasViewComponents('', SmartAdComponent::class)
        ->hasMigration('create_smart_ads_table');

    }

    /**
     * Register the application services.
     */
    public function registeringPackage()
    {
         // Register the main class to use with the facade
         $this->app->singleton('laravel-smart-ads', function () {
             return new LaravelSmartAds;
         });
    }

}
