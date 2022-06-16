<?php

namespace Kazelot\Geolocation;

class GeolocationResponse
{
    /**
     * All default geolocation properties.
     */
    public string $ip = '';
    public string $country = '';
    public string $countryCode = '';
    public string $city = '';
    public string $regionCode = '';
    public string $regionName = '';
    public string $zipCode = '';
    public float $latitude = 0.0;
    public float $longitude = 0.0;
    public string $isp = '';
    public string $timezone = '';
    public bool $inEu = false;

    /**
     * Create a new geolocation response instance.
     *
     * @param  $response
     * @param  $casts
     * @return void
     */
    public function __construct(
        protected array $response,
        protected array $casts
    ) {
        $this->parse();
    }

    /**
     * Standardize property names.
     *
     * @return void
     */
    protected function parse(): void
    {
        foreach ($this->casts as $key => $value) {
            // Sets the field of a given type to blank if the provider has not provided the field
            $emptyField = '';
            settype($emptyField, gettype($this->$key));

            $this->$key = $this->response[$value] ?? $emptyField;
        }
    }

    /**
     * Get all geolocation properties.
     *
     * @return array
     */
    public function toArray(): array
    {
        $reflectionObject = new \ReflectionObject($this);
        $properties = $reflectionObject->getProperties(\ReflectionProperty::IS_PUBLIC);

        $propertiesToReturn = [];

        foreach ($properties as $property) {
            $propertyName = $property->name;

            if (isset($this->casts[$propertyName])) {
                $propertiesToReturn[$propertyName] = $this->$propertyName;
            }
        }

        return $propertiesToReturn;
    }

    /**
     * Get single geolocation property.
     *
     * @return mixed
     */
    public function __call($name, $arguments): mixed
    {
        if (!property_exists(self::class, $name)) {
            throw new \Exception('Property ' . $name . ' not found.');
        }

        return $this->{$name};
    }
}
