<?php

namespace _5balloons\LaravelAdManager\Tests;

use _5balloons\LaravelAdManager\Models\LaravelAd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use _5balloons\LaravelAdManager\Tests\LaravelAdManagerTestCase as TestCase;

class LaravelAdManagerTest extends TestCase
{

    use RefreshDatabase;

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