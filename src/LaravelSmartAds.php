<?php

namespace _5balloons\LaravelSmartAds;

use Carbon\Carbon;
use _5balloons\LaravelSmartAds\Models\SmartAd;
use _5balloons\LaravelSmartAds\Models\SmartAdTracking;

class LaravelSmartAds
{
    public function updateClicks($slug){
        $smartAd = SmartAd::where('slug', $slug)->firstOrFail();
        $smartAd->clicks++;
        $smartAd->save();
        if(SmartAdTracking::whereDate('created_at', Carbon::today())->exists()){
            $smartAdTracking = SmartAdTracking::whereDate('created_at', Carbon::today())->first();
            $ad_clicks = json_decode($smartAdTracking->ad_clicks);
            if(isset($ad_clicks->{$smartAd->slug})){
                $ad_clicks->{$smartAd->slug}++;  //Increase clicks if already exists
            }else{
                $ad_clicks->{$smartAd->slug} = 1; //First click of the day
            }
            $totalClicks = $smartAdTracking->totalClicks + 1;
            $smartAdTracking->update([
                'ad_clicks' => json_encode($ad_clicks),
                'totalClicks' => $totalClicks
            ]);
        }else{
            SmartAdTracking::create([
                'totalClicks' => 1,
                'ad_clicks' => json_encode([$smartAd->slug => 1])
            ]);
        }
    }
}
