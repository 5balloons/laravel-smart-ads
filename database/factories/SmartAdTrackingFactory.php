<?php

namespace _5balloons\LaravelSmartAds\Database\Factories;

use _5balloons\LaravelSmartAds\Models\SmartAd;
use Illuminate\Database\Eloquent\Factories\Factory;
use _5balloons\LaravelSmartAds\Models\SmartAdTracking;

class SmartAdTrackingFactory extends Factory
{
    protected $model = SmartAdTracking::class;

    public function definition()
    {
        return [
            'ad_clicks' => json_encode(['test' => "6"]),
            'totalClicks' => 5,
        ];
    }
}