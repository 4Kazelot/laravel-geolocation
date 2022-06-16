<?php

namespace Kazelot\Geolocation\Drivers;

class IfConfigCo
{
    /**
     * The url of the geo api server.
     *
     * @return string
     */
    const BASEURL = 'https://ifconfig.co/json?ip={ip}';

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
        'countryCode' => 'country_iso',
        'city' => 'city',
        'regionCode' => 'region_code',
        'regionName' => 'region_name',
        'zipCode' => 'zip_code',
        'latitude' => 'latitude',
        'longitude' => 'latitude',
        'isp' => 'asn_org',
        'timezone' => 'time_zone',
        'inEu' => 'country_eu',
    ];
}
