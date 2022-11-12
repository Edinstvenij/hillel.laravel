<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\ProcessUserAgent;
use App\Services\Geo\GeoServiceInterface;
use itHillelDz19\UserAgentInterface\UserAgentInterface;

class GeoIpController
{

    public function index(GeoServiceInterface $reader, UserAgentInterface $userAgentObj)
    {
        $ip = request()->ip();
        $userAgent = request()->userAgent();

        ProcessUserAgent::dispatch($ip, $userAgent, $reader, $userAgentObj)->onQueue('parsing');
        return redirect()->route('main');
    }
}
