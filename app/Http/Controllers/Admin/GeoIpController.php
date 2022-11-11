<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\ProcessUserAgent;
use App\Models\UserAgent;
use App\Services\Geo\GeoServiceInterface;
use itHillelDz19\UserAgentInterface\UserAgentInterface;

class GeoIpController
{

    public function index(GeoServiceInterface $reader, UserAgentInterface $userAgent)
    {
        ProcessUserAgent::dispatch("50.7.93.27", $reader, $userAgent);


//        $ip = request()->ip();
//        $ip = "50.7.93.27";
//        $reader->parser($ip);
//        $city = $reader->getCity();
//        $country = $reader->getCountry();
//        $userAgent->parser(request()->userAgent());
//        $browser = $userAgent->getBrowser();
//        $system = $userAgent->getSystem();
//
//        $options = [
//            'user_id' => $ip,
//            'city' => $city,
//            'country' => $country,
//            'browser' => $browser,
//            'system' => $system
//        ];
//
//        $isOptionEmpty = false;
//        foreach ($options as $option) {
//            if ($option == null) {
//                $isOptionEmpty = true;
//            }
//        }
//        if ($isOptionEmpty === false) {
//            UserAgent::create($options);
//        }
    }
}
