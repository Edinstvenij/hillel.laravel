<?php

namespace App\Services\UserAgent;

interface UserAgentInterface
{
    /**
     * @param string $userAgent save param in var
     * @return void
     */
    public function parser(string $userAgent): void;

    /**
     * @return string|null
     */
    public function getBrowser(): ?string;

    /**
     * @return string|null
     */
    public function getSystem(): ?string;
}
