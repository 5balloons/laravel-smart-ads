<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use _5balloons\LaravelSmartAds\Models\SmartAd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use _5balloons\LaravelSmartAds\Tests\LaravelSmartAdsTestCase;
use _5balloons\LaravelAdManager\Database\Factories\LaravelAdFactory;

class SmartAdAdminTest extends LaravelSmartAdsTestCase
{

    /** @test */
    public function it_asserts_user_can_view_ads_on_dashboard(){
        $laravelAds = SmartAd::factory()->count(5)->create();
        $this->get('/smart-ad-manager/ads')
                ->assertSee($laravelAds->random()->name);
    }

}
