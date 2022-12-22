<?php

namespace _5balloons\LaravelAdManager;

use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelAdManagerServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
        ->name('laravel-ad-manager')
        ->hasRoute('web')
        ->hasMigration('create_laravel_ads_table');
    }

    /**
     * Register the application services.
     */
    public function registeringPackage()
    {
         // Register the main class to use with the facade
         $this->app->singleton('laravel-ad-manager', function () {
             return new LaravelAdManager;
         });
    }

}
