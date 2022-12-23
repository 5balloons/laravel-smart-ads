<?php

namespace _5balloons\LaravelAdManager;

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use _5balloons\LaravelAdManager\Http\Livewire\LaravelAdComponent;

class LaravelAdManagerServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
        ->name('laravel-ad-manager')
        ->hasViews()
        ->hasRoute('web')
        ->hasMigration('create_laravel_ads_table');

    }

    public function bootingPackage()
    {
        $this->registerLivewireComponents();
    }

    public function registerLivewireComponents(){
        Livewire::component('laravel-ad-component', LaravelAdComponent::class);
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
