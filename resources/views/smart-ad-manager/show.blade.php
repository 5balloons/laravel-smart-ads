@extends('smart-ads::layouts.app')
@section('content')
<div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Ad : {{$smartAd->name}}
        </h2>

        <!-- Alert Message -->
        @if(session()->has('message'))
        <div class="bg-{{session('color')}}-100 text-{{session('color')}}-800 p-4 text-sm rounded border border-{{session('color')}}-300 my-3">
                {{session('message')}}
        </div>
        @endif

        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="my-1 font-semibold text-gray-800">Ad Slug</div>
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                {{$smartAd->slug}}
            </h4>
            

            @if($smartAd->adType == "HTML")
            <div class="my-1 font-semibold text-gray-800">Ad HTML Body</div>
            <p class="text-gray-600 dark:text-gray-400">
                <pre><code class="lang-html">
                    {{ $smartAd->body }}
                </code></pre>
            </p>
            @elseif($smartAd->adType == "IMAGE")
            <div class="my-1 font-semibold text-gray-800">Ad Image</div>
            <p class="text-gray-600 dark:text-gray-400">
               <img src="{{asset('storage/'.$smartAd->image)}}" alt="{{$smartAd->imageAlt}}" />
            </p>

            <div class="my-1 font-semibold text-gray-800">Image URL</div>
            <p class="text-gray-500 dark:text-gray-400">
               <p>{{$smartAd->imageUrl}}</p>
            </p>
            @endif

            <div class="text-gray-600 mt-5">
                <div class="my-1 font-semibold text-gray-800">Usage (Manual Placement)</div>
                <div class="bg-gray-600 text-white rounded p-3">
                    <span><</span>x-smart-ad-component slug="{{$smartAd->slug}}"/>
                </div>
            </div>

            <div class="mt-5">
                <div class="my-1 font-semibold text-gray-800">Auto Placement</div>
                @isset($smartAd->placements)
                    @foreach(json_decode($smartAd->placements) as $placement)
                        @if(!empty($placement->selector))
                            @switch($placement->position)
                                @case('beforebegin')
                                    Before HTML Element
                                @break
                                @case('afterend')
                                    Before HTML Element
                                @break
                                @case('afterbegin')
                                    Inside HTML Selector (At Beginning)
                                @break
                                @case('beforeend')
                                    Inside HTML Selector (At End)
                                @break
                            @endswitch
                            -> {{$placement->selector}} <br/>
                        @endif
                    @endforeach
                @else
                    <p> No Auto placements set for this Ad</p>
                @endisset


            </div>

        </div>

        



</div>
@endsection