<?php

namespace _5balloons\LaravelSmartAds;

use _5balloons\LaravelSmartAds\Models\SmartAd;

class LaravelSmartAds
{
    public function updateClicks($slug){
        $smartAd = SmartAd::where('slug', $slug)->firstOrFail();
        $smartAd->clicks++;
        $smartAd->save();
    }
}
