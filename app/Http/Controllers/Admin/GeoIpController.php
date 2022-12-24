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
        if ($ip === '127.0.0.1' && !empty(request()->server->get('HTTP_X_FORWARDED_FOR'))) {
            $ip = request()->server->get('HTTP_X_FORWARDED_FOR');
        }

        $userAgent = request()->userAgent();

        ProcessUserAgent::dispatch($ip, $userAgent, $reader, $userAgentObj)->onQueue('parsing');
        return back()->withInput();
    }
}
