<?php

namespace _5balloons\LaravelAdManager\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\View;
use Livewire\LivewireServiceProvider;
use _5balloons\LaravelAdManager\LaravelAdManagerFacade;
use _5balloons\LaravelAdManager\LaravelAdManagerServiceProvider;

class LaravelAdManagerTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');

    }

    protected function getPackageProviders($app){
        return[
            LivewireServiceProvider::class,
            LaravelAdManagerServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return[
            'LaravelAdManager' => LaravelAdManagerFacade::class
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('view.paths', [
            __DIR__.'/../resources/views',
            resource_path('views'),
        ]);

        // import the CreatePostsTable class from the migration
        require_once __DIR__ . '/../database/migrations/create_laravel_ads_table.php.stub';

        // run the up() method of that migration class
        (new \CreateLaravelAdsTable)->up();
    }
}