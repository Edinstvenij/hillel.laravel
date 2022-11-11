<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\ProcessUserAgent;

class GeoIpController
{

    public function index()
    {
        ProcessUserAgent::dispatch(request()->ip(), request()->userAgent());
        return redirect()->route('main');
    }
}
