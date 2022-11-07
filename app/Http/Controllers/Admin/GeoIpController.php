<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserAgent;
use App\Services\Geo\GeoServiceInterface;
use itHillelDz19\UserAgentInterface\UserAgentInterface;
use itHillelDz19\JenssegersAgentService;

class GeoIpController
{

    public function index(GeoServiceInterface $reader, UserAgentInterface $userAgent)
    {
        $ip = request()->ip();
        $reader->parser($ip);
        $city = $reader->getCity();
        $country = $reader->getCountry();
        $browser = $userAgent->getBrowser();
        $system = $userAgent->getSystem();

        $options = [
            'user_id' => $ip,
            'city' => $city,
            'country' => $country,
            'browser' => $browser,
            'system' => $system
        ];

        $isOptionEmpty = false;
        foreach ($options as $option) {
            if ($option == null) {
                $isOptionEmpty = true;
            }
        }
        if ($isOptionEmpty === false) {
            UserAgent::create($options);
        }
    }
}
