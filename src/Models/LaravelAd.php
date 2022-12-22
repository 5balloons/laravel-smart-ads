<?php

namespace _5balloons\LaravelAdManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use _5balloons\LaravelAdManager\Database\Factories\LaravelAdFactory;


class LaravelAd extends Model{
    
    use HasFactory;

    protected static function newFactory()
    {
        return LaravelAdFactory::new();
    }


}