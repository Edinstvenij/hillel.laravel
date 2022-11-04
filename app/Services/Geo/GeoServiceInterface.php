<?php

namespace App\Services\Geo;

interface GeoServiceInterface
{
    public function parser(string $ip): void;

    public function getCity(): ?string;

    public function getCountry(): ?string;
}
