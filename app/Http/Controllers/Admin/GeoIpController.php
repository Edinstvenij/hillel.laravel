<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserAgent;
use App\Services\Geo\GeoServiceInterface;
use App\Services\UserAgent\UserAgentInterface;

class GeoIpController
{

    public function index(GeoServiceInterface $reader, UserAgentInterface $userAgent)
    {
        $ip = '62.16.4.185';
//        $ip = request()->ip();
        $reader->parser($ip);
        $city = $reader->getCity();
        $country = $reader->getCountry();
        $browser = $userAgent->getBrowser();
        $system = $userAgent->getSystem();

        $param = [
            'userId' => request()->ip(),
            'city' => $city,
            'country' => $country,
            'browser' => $browser,
            'system' => $system
        ];
        UserAgent::create($param);
    }

}
