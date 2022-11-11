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


    /**
     * Create a new job instance.
     *
     * @return void
     * @var string $ip user ip
     * @var string $userAgent string user agent
     */
    public function __construct(string $ip, string $userAgent)
    {
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(GeoServiceInterface $reader, UserAgentInterface $userAgent)
    {
        $reader->parser($this->ip);
        $city = $reader->getCity();
        $country = $reader->getCountry();

        $userAgent->parser($this->userAgent);
        $browser = $userAgent->getBrowser();
        $system = $userAgent->getSystem();

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
