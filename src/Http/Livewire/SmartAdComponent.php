<?php

namespace _5balloons\LaravelSmartAds\Http\Livewire;

use Livewire\Component;
use _5balloons\LaravelSmartAds\Models\SmartAd;


class SmartAdComponent extends Component
{
    public $adName;

    public function render()
    {
        $smartAd = SmartAd::where('name', $this->adName)->first();

        return view('smart-ads::livewire.smart-ad-component', compact('smartAd'));
    }
    

}