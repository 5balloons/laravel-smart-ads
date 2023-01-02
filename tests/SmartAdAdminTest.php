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
        $this->get('/smart-ad-manager')
                ->assertSee($laravelAds->random()->name);
    }

    /** @test */
    public function it_asserts_create_new_ad_page_works(){
        $this->get('/smart-ad-manager/ads/create')
            ->assertSee('Create New Ad');
    }

    /** @test */
    public function it_asserts_ad_name_is_required_to_create_new_ad(){
        $laravelAd = SmartAd::factory()->make(['name' => '']);
        $this->post('/smart-ad-manager/ads/store', $laravelAd->toArray())
            ->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_asserts_ad_name_is_unique(){
        $laravelAdExisting = SmartAd::factory()->create(['name' => 'ad-name']);
        $newLaravelAd = SmartAd::factory()->make(['name' => 'ad-name']);
        $this->post('/smart-ad-manager/ads/store', $newLaravelAd->toArray())
            ->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_asserts_ad_body_is_required_to_create_new_ad(){
        $laravelAd = SmartAd::factory()->make(['body' => '']);
        $this->post('/smart-ad-manager/ads/store', $laravelAd->toArray())
            ->assertSessionHasErrors(['body']);
    }


}
