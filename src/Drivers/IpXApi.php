<?php

namespace Kazelot\Geolocation\Drivers;

class IpXApi
{
    /**
     * The url of the geo api server.
     *
     * @return string
     */
    const BASEURL = 'https://ipxapi.com/api/ip?ip={ip}';

    /**
     * Timeout in seconds.
     *
     * @return int
     */
    const TIMEOUT = 0;

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
        'regionCode' => 'region',
        'regionName' => 'regionName',
        'zipCode' => 'zip',
        'latitude' => 'lat',
        'longitude' => 'lon',
        'isp' => 'isp',
        'timezone' => 'timezone',
        'inEu' => 'inEU',
    ];
}
