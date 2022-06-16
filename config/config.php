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

    'default' => 'IpLocateIo',

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

        'Local' => [
            'driver' => Kazelot\Geolocation\Drivers\Local::class,
            'api_key' => null,
        ],
    ],

];
