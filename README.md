![Laravel Geolocation](https://banners.beyondco.de/Laravel%20Geolocation.png?theme=light&packageManager=composer+require&packageName=kazelot%2Flaravel-geolocation&pattern=architect&style=style_1&description=A+simple+package+for+geolocation.&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

# 🌎 Laravel Geolocation package

[![Latest Stable Version](http://poser.pugx.org/kazelot/laravel-geolocation/v)](https://packagist.org/packages/kazelot/laravel-geolocation) [![Total Downloads](http://poser.pugx.org/kazelot/laravel-geolocation/downloads)](https://packagist.org/packages/kazelot/laravel-geolocation) [![Latest Unstable Version](http://poser.pugx.org/kazelot/laravel-geolocation/v/unstable)](https://packagist.org/packages/kazelot/laravel-geolocation) [![License](http://poser.pugx.org/kazelot/laravel-geolocation/license)](https://packagist.org/packages/kazelot/laravel-geolocation) [![PHP Version Require](http://poser.pugx.org/kazelot/laravel-geolocation/require/php)](https://packagist.org/packages/kazelot/laravel-geolocation)

> A simple package for geolocation.

## 🚀 Features

- Fetch users geolocation data without worrying about switching providers.
- This package can handle all providers and will standardize all geolocation names.
- Support for local databases.

## 📦 Installation

1. Add `kazelot/laravel-geolocation` dependency to your project

```bash
composer require kazelot/laravel-geolocation
```

>  This package requires PHP 8+ and was developed for Laravel 9.

The package will automatically register a service provider.

2. Publish the configuration file

```bash
php artisan vendor:publish --provider="Kazelot\Geolocation\GeolocationServiceProvider" --tag="config"
```

## 🦄 Usage

You can retrieve the selected field using a method or property.

```php
use Kazelot\Geolocation\Facades\Geolocation;

$geolocation = Geolocation::lookup();

echo $geolocation->city;
// or
echo $geolocation->city();
```
> The `lookup($ip = null)` method takes an optional parameter.\
> If you don't pass it, it will use the current ip address from request.

> 👉 You can also pass hostname instead of ip address. E.g. `lookup('google.com')`

To get an array with all the properties:

```php
$geolocation->toArray();
```

## 🌎 Default Geolocation Properties

> ⚠️ Please note that some geolocation providers may not return all properties listed here.

```php
[
    'ip' => string,
    'country' => string,
    'region_code' => string,
    'city' => string,
    'regionCode' => string,
    'regionName' => string
    'zipCode' => string,
    'latitude' => float,
    'longitude' => float,
    'isp' => string,
    'timezone' => string,
    'inEu' => bool,
]
```

## ⚙️ Config

If you need to add an api key or add a new driver, this can be easily achieved in config.

`config/geolocation.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Geolocation Provider
    |--------------------------------------------------------------------------
    | 
    | This is the default provider that will be used to get the geolocation.
    | The name specified in this option should match one of the providers
    | defined in the "providers" configuration array.
    |
    */

    'default' => 'IfConfigCo',

    /*
    |--------------------------------------------------------------------------
    | Geolocation Providers
    |--------------------------------------------------------------------------
    |
    | Default supported: "IfConfigCo", "IpApiIo", "IpXApi", "IpLocateIo"
    |
    */

    'providers' => [
        'IfConfigCo' => [
            'driver' => Kazelot\Geolocation\Drivers\IfConfigCo::class,
            'api_key' => env('GEOLOCATION_IFCONFIGCO_API_KEY'),
        ],

        'IpApiIo' => [
            'driver' => Kazelot\Geolocation\Drivers\IpApiIo::class,
            'api_key' => env('GEOLOCATION_IPAPIIO_API_KEY'),
        ],

        'IpXApi' => [
            'driver' => Kazelot\Geolocation\Drivers\IpXApi::class,
            'api_key' => env('GEOLOCATION_IPXAPI_API_KEY'),
        ],

        'IpLocateIo' => [
            'driver' => Kazelot\Geolocation\Drivers\IpLocateIo::class,
            'api_key' => env('GEOLOCATION_IPLOCATEIO_API_KEY'),
        ],

        // 'Local' => [
        //     'driver' => Kazelot\Geolocation\Drivers\Local::class,
        //     'api_key' => null,
        // ],
    ],

];

```

## 🗂️ Support for local database

If you want to retrieve data from a local database, this can be easily achieved by adding the `lookup()` method to the driver.
The package will automatically detect it and do the rest. Your local driver should return an array with geolocation data.

```php
<?php

namespace Kazelot\Geolocation\Drivers;

class Local
{
    public $casts = [
        'ip' => 'query',
        'country' => 'country',
        'countryCode' => 'countryCode',
        'city' => 'city',
        'regionCode' => 'regionCode',
        'regionName' => 'regionName',
        'zipCode' => 'zipCode',
        'latitude' => 'latitude',
        'longitude' => 'longitude',
        'isp' => 'isp',
        'timezone' => 'timezone',
        'inEu' => 'inEu',
    ];

    public function lookup(string $ip): array
    {
        // Your code to fetch the data

        $response = '{
            "query": "1.1.1.1",
            "country": "Australia",
            "countryCode": "AU",
            "city": "",
            "regionCode": "",
            "regionName": "",
            "zipCode": "01-233",
            "latitude": 0,
            "longitude": 0,
            "isp": "Isp Name",
            "timezone": "Australia/Sydney",
            "inEu": false
        }';

        return json_decode($response, true);
    }
}

```

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
