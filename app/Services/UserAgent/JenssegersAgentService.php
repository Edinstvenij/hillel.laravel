<?php

namespace App\Services\UserAgent;

use Jenssegers\Agent\Agent;

class JenssegersAgentService implements UserAgentInterface
{
    protected $agent;
    protected $userAgent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function parser(string $userAgent): void
    {
        $this->userAgent = $this->agent->getUserAgent();
    }

    public function getBrowser(): ?string
    {
        return $this->agent->browser();
    }

    public function getSystem(): ?string
    {
        return $this->agent->platform();
    }
}
