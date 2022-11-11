<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\ProcessUserAgent;
use App\Services\Geo\GeoServiceInterface;
use itHillelDz19\UserAgentInterface\UserAgentInterface;

class GeoIpController
{

    public function index()
    {
        ProcessUserAgent::dispatch("50.7.93.27", request()->userAgent());
        return redirect()->route('main');
    }
}
