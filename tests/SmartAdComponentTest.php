<?php

namespace _5balloons\LaravelSmartAds\Tests;

use Livewire\Livewire;
use _5balloons\LaravelSmartAds\Models\SmartAd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use _5balloons\LaravelSmartAds\Http\Livewire\SmartAdComponent;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use _5balloons\LaravelSmartAds\Tests\LaravelSmartAdsTestCase as TestCase;


class SmartAdComponentTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function it_asserts_component_renders_the_ad(){
        $smartAd = SmartAd::factory()->create(['name'=> 'test-ad', 'body' => 'Hello']);

        $view = $this->blade(
            '<x-smart-ad-component slug='.$smartAd->slug.'/>',
        );

        $view->assertSee($smartAd->body);

    }

    
}