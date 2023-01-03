<?php

namespace _5balloons\LaravelSmartAds\Http\Controllers;

use Illuminate\Routing\Controller;
use _5balloons\LaravelSmartAds\Models\SmartAd;
use _5balloons\LaravelSmartAds\Http\Requests\StoreSmartAdRequest;

class SmartAdManagerController extends Controller{

    public function index(){
        $smartAds = SmartAd::paginate(10);
        return view('smart-ads::smart-ad-manager.index', compact('smartAds'));
    }

    public function show(SmartAd $smartAd){
        return view('smart-ads::smart-ad-manager.show', compact('smartAd'));
    }

    public function create(){
        return view('smart-ads::smart-ad-manager.create');
    }

    public function store(StoreSmartAdRequest $request){
        $smartAd = SmartAd::create([
            'name' => $request->name,
            'slug' => $this->slug($request->name),
            'body' => $request->body
        ]);
        return redirect("/smart-ad-manager/ads/{$smartAd->id}")->with(['message' => 'Ad Created', 'color' => 'green']);
    }

    public function edit(SmartAd $smartAd){
        return view('smart-ads::smart-ad-manager.edit', compact('smartAd'));
    }

    public function update(StoreSmartAdRequest $request, SmartAd $smartAd){
        $smartAd->name = $request->name;
        $smartAd->body = $request->body;
        $smartAd->save();
        return redirect("/smart-ad-manager/ads/{$smartAd->id}")->with(['message' => 'Ad Edited', 'color' => 'green']);
    }

    public function delete(SmartAd $smartAd){
        $smartAd->delete();
        return redirect('/smart-ad-manager')->with(['message' => 'Ad Deleted', 'color' => 'green']);
    }

    public function slug($data)
    {
        $ex = explode(' ', $data);
        return implode('-', $ex);
    }
}

