<?php

namespace Kazelot\Geolocation\Drivers;

class IpLocateIo
{
    /**
     * The url of the geo api server.
     *
     * @return string
     */
    const BASEURL = 'https://iplocate.io/api/lookup/{ip}';

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
        'ip' => 'ip',
        'country' => 'country',
        'countryCode' => 'country_code',
        'city' => 'city',
        'regionName' => 'subdivision',
        'zipCode' => 'postal_code',
        'latitude' => 'latitude',
        'longitude' => 'longitude',
        'isp' => 'org',
        'timezone' => 'time_zone',
    ];
}
