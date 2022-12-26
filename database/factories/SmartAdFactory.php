<?php

namespace _5balloons\LaravelSmartAds\Database\Factories;

use _5balloons\LaravelSmartAds\Models\SmartAd;
use Illuminate\Database\Eloquent\Factories\Factory;

class SmartAdFactory extends Factory
{
    protected $model = SmartAd::class;

    public function definition()
    {
        return [
            'name' => fake()->word.' '.fake()->word,
            'body' => fake()->randomHtml(),
            
        ];
    }
}