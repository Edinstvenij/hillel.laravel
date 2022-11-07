<?php

namespace App\Services\UserAgent;

use donatj\UserAgent\UserAgentParser;

class PhpUserAgentService implements UserAgentInterface
{

    protected $userAgentObj;
    protected $userAgent;

    public function __construct()
    {
        $this->userAgentObj = new UserAgentParser();
    }

    public function parser($userAgent): void
    {
        $this->userAgent = $this->userAgentObj->parse($userAgent);
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
