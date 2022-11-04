<?php

namespace App\Services\UserAgent;

interface UserAgentInterface
{
    public function getBrowser(): ?string;

    public function getSystem(): ?string;
}
