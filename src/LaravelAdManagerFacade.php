<?php

namespace _5balloons\LaravelAdManager;

use Illuminate\Support\Facades\Facade;

/**
 * @see \5balloons\LaravelAdManager\Skeleton\SkeletonClass
 */
class LaravelAdManagerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-ad-manager';
    }
}
