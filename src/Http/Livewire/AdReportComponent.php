<?php

namespace _5balloons\LaravelSmartAds\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use _5balloons\LaravelSmartAds\Models\SmartAdTracking;

class AdReportComponent extends Component
{
    // Report Start and End Date
    public $reportStartDate;
    public $reportEndDate;

    //Properties to show report data
    public $totalClicksToday = 0;
    public $totalClicksYesterday = 0;
    public $totalClicks7Days = 0;
    public $totalClicksThisMonth = 0;



    public function render()
    {
        $this->totalClicksToday = SmartAdTracking::whereDate('created_at', Carbon::today())->sum('totalClicks');
        $this->totalClicksYesterday = SmartAdTracking::whereDate('created_at', Carbon::yesterday())->sum('totalClicks');
        $this->totalClicks7Days = SmartAdTracking::whereBetween(DB::raw('DATE(created_at)'), [Carbon::today()->subDays(7), Carbon::today()])->sum('totalClicks');
        $this->totalClicksThisMonth = SmartAdTracking::whereMonth('created_at', Carbon::now()->month)->sum('totalClicks');
        return view('smart-ads::livewire.ad-report-component');
    }


}
