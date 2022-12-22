<?php

namespace _5balloons\LaravelAdManager\Tests;

use Orchestra\Testbench\TestCase;
use _5balloons\LaravelAdManager\Models\LaravelAd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use _5balloons\LaravelAdManager\LaravelAdManagerFacade;
use _5balloons\LaravelAdManager\LaravelAdManagerServiceProvider;

class LaravelAdManagerTest extends TestCase
{

    use RefreshDatabase;

    protected function getPackageProviders($app){
        return[
            LaravelAdManagerServiceProvider::class
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
        // import the CreatePostsTable class from the migration
        require_once __DIR__ . '/../database/migrations/create_laravel_ads_table.php.stub';

        // run the up() method of that migration class
        (new \CreateLaravelAdsTable)->up();
    }

    /** @test */
    public function it_asserts_a_laravel_ad_has_a_name(){
        $laravelAd = LaravelAd::factory()->create(['name' => 'Alright']);
        $this->assertEquals('Alright', $laravelAd->name);
    }

    /** @test */
    public function it_asserts_a_laravel_ad_has_a_body(){
        $laravelAd = LaravelAd::factory()->create(['body' => '<span>Hello</span>']);
        $this->assertEquals('<span>Hello</span>', $laravelAd->body);
    }
    
}