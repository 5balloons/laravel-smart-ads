<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use _5balloons\LaravelSmartAds\Models\SmartAd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use _5balloons\LaravelSmartAds\Models\SmartAdTracking;
use _5balloons\LaravelSmartAds\Tests\LaravelSmartAdsTestCase;
use _5balloons\LaravelAdManager\Database\Factories\LaravelAdFactory;

class SmartAdTrackingTest extends LaravelSmartAdsTestCase
{

    /** @test */
    public function it_asserts_ads_tracking_is_updated_when_user_clicks_on_ad(){
        //Given that we have an Ad in the database
        $smartAd = SmartAd::factory()->create();
        //User clicks on the ad
        $this->post('/smart-banner-update-clicks', ['slug' => $smartAd->slug]);
        //Ad clicks count is updated in smart_ads_table
        $smartAd->refresh();
        $this->assertEquals(1, $smartAd->clicks);
        //Ad Clicks gets updated in smart_ads_tracking_table
        $smartAdTracking = SmartAdTracking::whereDate('created_at', Carbon::today())->first();
        $this->assertEquals(1, json_decode($smartAdTracking->ad_clicks)->{$smartAd->slug});
        $this->assertEquals(1, $smartAdTracking->totalClicks);
    }


    /** @test */
    public function it_asserts_click_tracking_works_with_multiple_clicks(){
        //Given that we have an Ad in the database
        $smartAd = SmartAd::factory()->create();
        //User clicks on the ad multiple times
        $this->post('/smart-banner-update-clicks', ['slug' => $smartAd->slug]);
        $this->post('/smart-banner-update-clicks', ['slug' => $smartAd->slug]);
        //Ad Clicks gets updated in smart_ads_tracking_table
        $smartAdTracking = SmartAdTracking::whereDate('created_at', Carbon::today())->first();
        $this->assertEquals(2, json_decode($smartAdTracking->ad_clicks)->{$smartAd->slug});
        $this->assertEquals(2, $smartAdTracking->totalClicks);
    }

    /** @test */
    public function it_asserts_click_tracking_works_with_multiple_ads(){
        //Given that we have multiple Ad in the database
        $smartAd1 = SmartAd::factory()->create();
        $smartAd2 = SmartAd::factory()->create();
        //User clicks on the ad multiple times
        $this->post('/smart-banner-update-clicks', ['slug' => $smartAd1->slug]);
        $this->post('/smart-banner-update-clicks', ['slug' => $smartAd2->slug]);
        //Ad Clicks gets updated in smart_ads_tracking_table
        $smartAdTracking = SmartAdTracking::whereDate('created_at', Carbon::today())->first();
        $this->assertEquals(1, json_decode($smartAdTracking->ad_clicks)->{$smartAd1->slug});
        $this->assertEquals(1, json_decode($smartAdTracking->ad_clicks)->{$smartAd2->slug});
        $this->assertEquals(2, $smartAdTracking->totalClicks);
    }

    /** @test */
    public function it_asserts_click_tracking_works_with_multiple_ads_and_multiple_clicks(){
        //Given that we have multiple Ad in the database
        $smartAd1 = SmartAd::factory()->create();
        $smartAd2 = SmartAd::factory()->create();
        //User clicks on the ad multiple times
        $this->post('/smart-banner-update-clicks', ['slug' => $smartAd1->slug]);
        $this->post('/smart-banner-update-clicks', ['slug' => $smartAd1->slug]);
        $this->post('/smart-banner-update-clicks', ['slug' => $smartAd1->slug]);
        $this->post('/smart-banner-update-clicks', ['slug' => $smartAd2->slug]);
        $this->post('/smart-banner-update-clicks', ['slug' => $smartAd2->slug]);
        //Ad Clicks gets updated in smart_ads_tracking_table
        $smartAdTracking = SmartAdTracking::whereDate('created_at', Carbon::today())->first();
        $this->assertEquals(3, json_decode($smartAdTracking->ad_clicks)->{$smartAd1->slug});
        $this->assertEquals(2, json_decode($smartAdTracking->ad_clicks)->{$smartAd2->slug});
        $this->assertEquals(5, $smartAdTracking->totalClicks);
    }

}
