<?php

namespace _5balloons\LaravelSmartAds;

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use _5balloons\LaravelSmartAds\Components\SmartAdComponent;
use _5balloons\LaravelSmartAds\Http\Livewire\AdReportComponent;

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
        ->hasMigrations(['create_smart_ads_table','create_smart_ads_tracking_table']);

    }

    public function bootingPackage()
    {
        $this->registerLivewireComponents();
    }

    public function registerLivewireComponents(){
        Livewire::component('ad-report-component', AdReportComponent::class);
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
