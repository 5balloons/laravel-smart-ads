<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use _5balloons\LaravelSmartAds\Models\SmartAd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use _5balloons\LaravelSmartAds\Models\SmartAdTracking;
use _5balloons\LaravelSmartAds\Tests\LaravelSmartAdsTestCase;
use _5balloons\LaravelSmartAds\Http\Livewire\AdReportComponent;
use _5balloons\LaravelAdManager\Database\Factories\LaravelAdFactory;
use _5balloons\LaravelSmartAds\LaravelSmartAds;

class SmartAdDashboardTest extends LaravelSmartAdsTestCase
{

    /** @test */
    public function it_asserts_dashboard_has_correct_clicks_data(){
        SmartAdTracking::factory()->create(['totalClicks' => 5]);
        SmartAdTracking::factory()->create(['totalClicks' => 10, 'created_at' => Carbon::yesterday()]);
        SmartAdTracking::factory()->create(['totalClicks' => 6, 'created_at' => Carbon::today()->subDays(2)]);
        
        $component = Livewire::test(AdReportComponent::class);
        $component->assertSet('totalClicksToday', 5);
        $component->assertSet('totalClicksYesterday', 10);
        $component->assertSet('totalClicks7Days', 21);

    }

    /** @test */
    public function it_asserts_dashboard_has_correct_monthly_clicks_data(){
        SmartAdTracking::factory()->create(['totalClicks' => '10', 'created_at' => '01-'.Carbon::now()->format('m').'-'.Carbon::now()->year]);
        SmartAdTracking::factory()->create(['totalClicks' => '5', 'created_at' => '03-'.Carbon::now()->format('m').'-'.Carbon::now()->year]);
        SmartAdTracking::factory()->create(['totalClicks' => '18', 'created_at' => '10-'.Carbon::now()->format('m').'-'.Carbon::now()->year]);
        SmartAdTracking::factory()->create(['totalClicks' => '4', 'created_at' => '15-'.Carbon::now()->format('m').'-'.Carbon::now()->year]);

        $component = Livewire::test(AdReportComponent::class);
        $component->assertSet('totalClicksThisMonth', 37);
    }

    /** @test */
    public function it_asserts_correct_data_is_sent_to_graph(){

        //Given that we have ad tracking for the last 7 days
        SmartAdTracking::factory()->create(['totalClicks' => 5]);
        SmartAdTracking::factory()->create(['totalClicks' => 10, 'created_at' => Carbon::yesterday()]);
        SmartAdTracking::factory()->create(['totalClicks' => 7, 'created_at' => Carbon::today()->subDays(2)]);
        SmartAdTracking::factory()->create(['totalClicks' => 1, 'created_at' => Carbon::today()->subDays(3)]);
        SmartAdTracking::factory()->create(['totalClicks' => 3, 'created_at' => Carbon::today()->subDays(5)]);
        SmartAdTracking::factory()->create(['totalClicks' => 4, 'created_at' => Carbon::today()->subDays(6)]);
        SmartAdTracking::factory()->create(['totalClicks' => 5, 'created_at' => Carbon::today()->subDays(7)]);

        $component = Livewire::test(AdReportComponent::class)
                        ->set('reportStartDate', Carbon::today()->subDays(7)->format('Y-m-d'))
                        ->set('reportEndDate', Carbon::today()->format('Y-m-d'))
                        ->call('calculateClicksReport');

                
        $component->assertSet('clicksPerDate', [
                        Carbon::today()->subDays(7)->format('Y-m-d') => 5,
                        Carbon::today()->subDays(6)->format('Y-m-d') => 4,
                        Carbon::today()->subDays(5)->format('Y-m-d') => 3,
                        Carbon::today()->subDays(4)->format('Y-m-d') => 0,
                        Carbon::today()->subDays(3)->format('Y-m-d') => 1,
                        Carbon::today()->subDays(2)->format('Y-m-d') => 7,
                        Carbon::today()->subDays(1)->format('Y-m-d') => 10,
                        Carbon::today()->subDays(0)->format('Y-m-d') => 5
        ]);
        
    }

    /** @test */
    public function it_asserts_correct_ad_clicks_are_shown_in_report(){
        //Given that we have an ad
        $smartAd = SmartAd::factory()->create();
        //That has been clicked over the span of few days
        SmartAdTracking::factory()->create(['ad_clicks' => json_encode([$smartAd->slug => '5'])]);
        SmartAdTracking::factory()->create(['ad_clicks' => json_encode([$smartAd->slug => '5']),  'created_at' => Carbon::yesterday()]);
        SmartAdTracking::factory()->create(['ad_clicks' => json_encode([$smartAd->slug => '7']),  'created_at' => Carbon::today()->subDays(2)]);
        SmartAdTracking::factory()->create(['ad_clicks' => json_encode([$smartAd->slug => '10']),  'created_at' => Carbon::today()->subDays(3)]);

        $component = Livewire::test(AdReportComponent::class)
                        ->set('reportStartDate', Carbon::today()->subDays(7)->format('Y-m-d'))
                        ->set('reportEndDate', Carbon::today()->format('Y-m-d'))
                        ->call('calculateClicksReport');

        $component->assertSet('clicksPerAd', [
            [
                'name' => $smartAd->name,
                'clicks' => 27
            ]
        ]);                        

    }

    /** @test */
    public function it_asserts_correct_ad_clicks_for_multiple_ads_are_shown_in_report(){
        //Given that we have two ads
        $smartAd1 = SmartAd::factory()->create();
        $smartAd2 = SmartAd::factory()->create();
        //That has been clicked over the span of few days
        SmartAdTracking::factory()->create(['ad_clicks' => json_encode([$smartAd1->slug => '5'])]);
        SmartAdTracking::factory()->create(['ad_clicks' => json_encode([$smartAd1->slug => '5', $smartAd2->slug => '6']),  'created_at' => Carbon::yesterday()]);
        SmartAdTracking::factory()->create(['ad_clicks' => json_encode([$smartAd1->slug => '7']),  'created_at' => Carbon::today()->subDays(2)]);
        SmartAdTracking::factory()->create(['ad_clicks' => json_encode([$smartAd1->slug => '10', $smartAd2->slug => '5']),  'created_at' => Carbon::today()->subDays(3)]);

        $component = Livewire::test(AdReportComponent::class)
                        ->set('reportStartDate', Carbon::today()->subDays(7)->format('Y-m-d'))
                        ->set('reportEndDate', Carbon::today()->format('Y-m-d'))
                        ->call('calculateClicksReport');

        $component->assertSet('clicksPerAd', [
            [
                'name' => $smartAd1->name,
                'clicks' => 27
            ],
            [
                'name' => $smartAd2->name,
                'clicks' => 11
            ]
        ]);                        

    }
    
}