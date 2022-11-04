<?php

namespace App\Services\UserAgent;

use donatj\UserAgent\UserAgentParser;

class PhpUserAgentService implements UserAgentInterface
{

    protected $userAgent;

    public function __construct()
    {
        $this->userAgent = new UserAgentParser();
        $this->userAgent = $this->userAgent->parse();
    }

    public function getBrowser(): ?string
    {
        return $this->userAgent->browser();
    }

    public function getSystem(): ?string
    {
        return $this->userAgent->platform();
    }

}
