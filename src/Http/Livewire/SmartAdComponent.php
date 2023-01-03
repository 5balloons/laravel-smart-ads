<?php

namespace _5balloons\LaravelSmartAds\Http\Livewire;

use Livewire\Component;
use _5balloons\LaravelSmartAds\Models\SmartAd;


class SmartAdComponent extends Component
{
    public $ad;

    public function render()
    {
        $smartAd = SmartAd::where('name', $this->ad)->first();

        return view('smart-ads::livewire.smart-ad-component', compact('smartAd'));
    }
    

}