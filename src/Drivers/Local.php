<?php

namespace Kazelot\Geolocation\Drivers;

class Local
{
    /**
     * Standardize property names.
     *
     * @var array
     */
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

    /**
     * Custom lookup method.
     *
     * @var array
     */
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
