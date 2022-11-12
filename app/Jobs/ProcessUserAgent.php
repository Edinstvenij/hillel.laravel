<?php

namespace App\Jobs;

use App\Models\UserAgent;
use App\Services\Geo\GeoServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use itHillelDz19\UserAgentInterface\UserAgentInterface;

class ProcessUserAgent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $ip;
    public $reader;
    public $userAgent;
    public $userAgentObj;


    /**
     * Create a new job instance.
     *
     * @return void
     * @var string $ip user ip
     * @var string $userAgent string user agent
     * @var UserAgentInterface $userAgentObj
     * @var GeoServiceInterface $reader
     */
    public function __construct(string $ip, string $userAgent, GeoServiceInterface $reader, UserAgentInterface $userAgentObj)
    {
        $this->ip = $ip;
        $this->userAgent = $userAgent;
        $this->reader = $reader;
        $this->userAgentObj = $userAgentObj;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->reader->parser($this->ip);
        $city = $this->reader->getCity();
        $country = $this->reader->getCountry();

        $this->userAgentObj->parser($this->userAgent);
        $browser = $this->userAgentObj->getBrowser();
        $system = $this->userAgentObj->getSystem();

        $options = [
            'user_id' => $this->ip,
            'city' => $city,
            'country' => $country,
            'browser' => $browser,
            'system' => $system
        ];

        foreach ($options as $key => $option) {
            if ($option === null) {
                echo $option . 'is empty';
                $options[$key] = 'Empty';
            }
        }
        UserAgent::create($options);
    }
}
