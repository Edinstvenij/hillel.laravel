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
     * @var string $reader string user ip
     * @var string $userAgent string user agent
     */
    public function __construct(string $ip, GeoServiceInterface $reader, UserAgentInterface $userAgent)
    {
        $this->ip = $ip;
        $this->reader = $reader;
        $this->userAgent = $userAgent;
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
        $this->userAgent->parser(request()->userAgent());
        $browser = $this->userAgent->getBrowser();
        $system = $this->userAgent->getSystem();

        $options = [
            'user_id' => $this->ip,
            'city' => $city,
            'country' => $country,
            'browser' => $browser,
            'system' => $system
        ];

        $isOptionEmpty = false;
        foreach ($options as $option) {
            if ($option == null) {
                $isOptionEmpty = true;
            }
        }
        if ($isOptionEmpty === false) {
            UserAgent::create($options);
        }
    }
}
