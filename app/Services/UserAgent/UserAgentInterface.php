<?php

namespace App\Services\UserAgent;

interface UserAgentInterface
{
//    public function parser(string $userAgent): void;

    public function getBrowser();

    public function getSystem(): ?string;
}
