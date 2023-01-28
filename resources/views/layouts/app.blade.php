<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laravel Smart Ads Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link href="{{asset('vendor/smart-ads/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/smart-ads/css/prism.css')}}" rel="stylesheet">
    @yield('styles')
    <script
      src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
      defer
    ></script>
    <script src="{{asset('vendor/smart-ads/js/banner-manager.js')}}"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    @livewireStyles
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      @include('smart-ads::layouts.partials.desktop-sidebar')
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      @include('smart-ads::layouts.partials.mobile-sidebar')
      <div class="flex flex-col flex-1 w-full">
        @include('smart-ads::layouts.partials.header')
        <main class="h-full overflow-y-auto">
            @yield('content')
        </main>
      </div>
    </div>
    @yield('scripts')
    @livewireScripts
  </body>
</html>