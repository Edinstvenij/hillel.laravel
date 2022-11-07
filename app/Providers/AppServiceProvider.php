<?php

namespace App\Providers;

use App\Services\Geo\GeoServiceInterface;
use App\Services\Geo\MaxmindService;
use App\Services\UserAgent\JenssegersAgentService;
use App\Services\UserAgent\PhpUserAgentService;
use App\Services\UserAgent\UserAgentInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GeoServiceInterface::class, function () {
            return new MaxmindService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
