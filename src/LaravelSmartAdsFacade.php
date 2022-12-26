<?php

namespace _5balloons\LaravelSmartAds;

use Illuminate\Support\Facades\Facade;

/**
 * @see \5balloons\LaravelSmartAds\Skeleton\SkeletonClass
 */
class LaravelSmartAdsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-smart-ads';
    }
}
