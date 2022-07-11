<?php

namespace Kazelot\Geolocation;

use Illuminate\Support\Facades\Http;

class Geolocation
{
    /**
     * Geolocation provider.
     *
     * @var mixed
     */
    protected mixed $provider;

    /**
     * Geolocation driver.
     *
     * @var object
     */
    protected object $driver;

    /**
     * Create a new geolocation instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setProvider();
        $this->setDriver();
    }

    /**
     * Fetch data from api.
     *
     * @return GeolocationResponse
     */
    public function lookup(string|null $ip = null): GeolocationResponse
    {
        $ip = $this->getIp($ip);

        if (method_exists($this->driver, 'lookup')) {
            return new GeolocationResponse($this->driver->lookup($ip), $this->driver->casts);
        }

        $url = $this->getUrl($ip);

        $response = Http::acceptJson()
            ->withToken($this->provider['api_key'])
            ->timeout($this->driver::TIMEOUT * 1000)
            ->get($url)
            ->json();

        return new GeolocationResponse($response, $this->driver->casts);
    }

    /**
     * Set default provider.
     *
     * @return void
     */
    protected function setProvider(): void
    {
        $config = config('geolocation');

        if (!$config) {
            throw new GeolocationException('Geolocation config not found.');
        }

        $defaultProvider = $config['default'];

        if (!$defaultProvider) {
            throw new GeolocationException('Default provider not found.');
        }

        if (!array_key_exists($defaultProvider, $config['providers'])) {
            throw new GeolocationException('Provider not found.');
        }

        $this->provider = $config['providers'][$defaultProvider];
    }

    /**
     * Set default driver.
     *
     * @return void
     */
    protected function setDriver(): void
    {
        $driverClass = $this->provider['driver'];

        $this->driver = new $driverClass();
    }

    /**
     * Get a prepared ip.
     *
     * @return string
     */
    protected function getIp(string $ip = null): string
    {
        if (!$ip) {
            return request()->ip();
        }

        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            return gethostbyname($ip);
        }

        return $ip;
    }

    /**
     * Get a prepared url.
     *
     * @return string
     */
    protected function getUrl(string $ip): string
    {
        return str_replace('{ip}', $ip, $this->driver::BASEURL);
    }
}
