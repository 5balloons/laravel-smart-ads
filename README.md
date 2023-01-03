# Ad Manager for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/5balloons/laravel-smart-ads.svg?style=flat-square)](https://packagist.org/packages/5balloons/laravel-smart-ads)
[![Total Downloads](https://img.shields.io/packagist/dt/5balloons/laravel-smart-ads.svg?style=flat-square)](https://packagist.org/packages/5balloons/laravel-smart-ads)
![GitHub Actions](https://github.com/5balloons/laravel-smart-ads/actions/workflows/main.yml/badge.svg)

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

