<?php

namespace _5balloons\LaravelAdManager\Database\Factories;

use _5balloons\LaravelAdManager\Models\LaravelAd;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaravelAdFactory extends Factory
{
    protected $model = LaravelAd::class;

    public function definition()
    {
        return [
            'name' => fake()->word,
            'body' => fake()->randomHtml(),
            
        ];
    }
}