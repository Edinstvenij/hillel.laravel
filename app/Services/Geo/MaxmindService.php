<?php

namespace App\Services\Geo;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class MaxmindService implements GeoServiceInterface
{
    protected $reader;
    protected $_data;

    public function __construct()
    {
        $this->reader = new Reader(
            base_path() . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'geoip' . DIRECTORY_SEPARATOR . 'GeoLite2-City.mmdb'
        );
    }

    public function parser(string $ip): void
    {
        try {

            $this->_data = $this->reader->city($ip) ?? null;
        } catch (AddressNotFoundException) {
            $this->_data = null;
        }
    }

    public function getCity(): ?string
    {
        if ($this->_data !== null) {
            return $this->_data->city->name;
        }
        return null;
    }

    public function getCountry(): ?string
    {
        if ($this->_data !== null) {
            return $this->_data->country->name;
        }
        return null;
    }
}
