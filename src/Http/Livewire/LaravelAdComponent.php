<?php

namespace _5balloons\LaravelAdManager\Http\Livewire;

use Livewire\Component;
use _5balloons\LaravelAdManager\Models\LaravelAd;


class LaravelAdComponent extends Component
{
    public $adName;

    public function render()
    {
        $laravelAd = LaravelAd::where('name', $this->adName)->first();

        return view('ad-manager::livewire.laravel-ad-component', compact('laravelAd'));
    }
    

}