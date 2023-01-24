<?php

namespace _5balloons\LaravelSmartAds\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use _5balloons\LaravelSmartAds\Database\Factories\SmartAdTrackingFactory;


class SmartAdTracking extends Model{
    
    use HasFactory;

    protected $table = 'smart_ads_tracking';

    protected $guarded = [];

    protected static function newFactory()
    {
        return SmartAdTrackingFactory::new();
    }


}