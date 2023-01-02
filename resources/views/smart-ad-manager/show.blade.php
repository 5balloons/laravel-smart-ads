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
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                {{$smartAd->name}}
            </h4>
            <p class="text-gray-600 dark:text-gray-400">
                {{$smartAd->body}}
            </p>
        </div>



</div>
@endsection