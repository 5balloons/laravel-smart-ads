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
    
}