<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\ProcessUserAgent;
use App\Services\Geo\GeoServiceInterface;
use itHillelDz19\UserAgentInterface\UserAgentInterface;

class GeoIpController
{

    public function index()
    {
        ProcessUserAgent::dispatch(request()->ip());
        return redirect()->route('main');
    }
}
