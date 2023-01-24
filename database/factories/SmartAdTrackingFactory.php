<?php

namespace _5balloons\LaravelSmartAds\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use _5balloons\LaravelSmartAds\Models\SmartAdTracking;

class SmartAdTrackingFactory extends Factory
{
    protected $model = SmartAdTracking::class;

    public function definition()
    {
       
        return [
            'ad_clicks' => '{
                "1" : "3",
                "2" : "2",
              }',
            'totalClicks' => 5,
        ];
    }
}