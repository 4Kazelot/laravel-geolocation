<?php

namespace Kazelot\Geolocation\Drivers;

class IpApiIo
{
    /**
     * The url of the geo api server.
     *
     * @return string
     */
    const BASEURL = 'https://ip-api.io/json/{ip}';

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
        'country' => 'country_name',
        'countryCode' => 'country_code',
        'city' => 'city',
        'regionCode' => 'region_code',
        'regionName' => 'region_name',
        'zipCode' => 'zip_code',
        'latitude' => 'latitude',
        'longitude' => 'longitude',
        'isp' => 'organisation',
        'timezone' => 'time_zone',
        'inEu' => 'is_in_european_union',
    ];
}
