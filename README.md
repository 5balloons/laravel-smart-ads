# Ad Manager for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/5balloons/laravel-smart-ads.svg?style=flat-square)](https://packagist.org/packages/5balloons/laravel-smart-ads)
[![Total Downloads](https://img.shields.io/packagist/dt/5balloons/laravel-smart-ads.svg?style=flat-square)](https://packagist.org/packages/5balloons/laravel-smart-ads)
![GitHub Actions](https://github.com/5balloons/laravel-smart-ads/actions/workflows/main.yml/badge.svg)

![alt text](/art/Laravel%20Smart%20Ads.png?raw=true "Larvel Smart Ads Dashboard")

Simple Ad, Banner, Callouts Manager for Laravel. 


## Installation

You can install the package via composer:

```bash
composer require 5balloons/laravel-smart-ads
```

The package will automatically register itself.

Publishing Migrations (Required)

```bash
php artisan vendor:publish --provider="_5balloons\LaravelSmartAds\LaravelSmartAdsServiceProvider" --tag="smart-ads-migrations"
```

and then run migrate command to run the migrations

```bash
php artisan migrate
```

Publishing Assets (Required)

```bash
php artisan vendor:publish --provider="_5balloons\LaravelSmartAds\LaravelSmartAdsServiceProvider" --tag="smart-ads-assets"
```
This command will copy the necessary css and js files required to run the ad manager dashboard. 

Publishing Config File (Optional)

```bash
php artisan vendor:publish --provider="_5balloons\LaravelSmartAds\LaravelSmartAdsServiceProvider" --tag="smart-ads-config"
```

## Usage

The ad manager dashboard can now be accessed at `/smart-ad-manager`

![alt text](https://raw.githubusercontent.com/5balloons/laravel-smart-ads/main/art/smart-ads-dashboard.png)

### Creating Ads

You can create a new ad by navigating to `smart-ad-manager/ads/create` page and then providing a valid name and HTML body of the Ad. 

![alt text](https://raw.githubusercontent.com/5balloons/laravel-smart-ads/main/art/smart-ads-create-new.png)


### Placing Ads 

In order to place the ads and track clicks you must place the following JS in your header (typically this would go in your blade layout file)

```html
<script src="{{ asset('vendor/smart-ads/js/smart-banner.min.js') }}"></script>
```

There are two ways in which you can place ads / banners in your application

#### (Manual Placement)
To manually place an ad you can copy the blade component code from the view ad page and place it at desired location in your blade file. For example an ad with the slug of your-example-ad can be placed with the following code.

```html
<x-smart-ad-component slug="your-example-ad"/>
```

#### (Auto Placement)

You can choose to auto place at the ads at the desired locations on the website by providing the CSS selector where you are looking to place the ad and choosing the position (Before selector, After selector, inside selector etc. to place the ad)

![alt text](https://raw.githubusercontent.com/5balloons/laravel-smart-ads/main/art/ad-auto-placement.png)


### Tracking Clicks

Tracking clicks is enabled by default and in order for it to work you must include a global meta csrf token in your blade template file, inside the head element of your HTML.

```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```


### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email tushar@5balloons.info instead of using the issue tracker.

## Credits

-   [Tushar Gugnani](https://github.com/tushargugnani)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

