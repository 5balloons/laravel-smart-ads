<?php

namespace _5balloons\LaravelSmartAds\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\View;
use Livewire\LivewireServiceProvider;
use _5balloons\LaravelSmartAds\LaravelSmartAdsFacade;
use _5balloons\LaravelSmartAds\LaravelSmartAdsServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class LaravelSmartAdsTestCase extends TestCase
{
    use InteractsWithViews;

    
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');

    }

    protected function getPackageProviders($app){
        return[
            LivewireServiceProvider::class,
            LaravelSmartAdsServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return[
            'LaravelSmartAds' => LaravelSmartAdsFacade::class
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('view.paths', [
            __DIR__.'/../resources/views',
            resource_path('views'),
        ]);

        // import the CreatePostsTable class from the migration
        require_once __DIR__ . '/../database/migrations/create_smart_ads_table.php.stub';
        require_once __DIR__ . '/../database/migrations/create_smart_ads_tracking_table.php.stub';

        // run the up() method of that migration class
        (new \CreateSmartAdsTable)->up();
        (new \CreateSmartAdsTrackingTable)->up();
    }
}