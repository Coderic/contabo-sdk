<?php

declare(strict_types=1);

namespace Coderic\Contabo\Auth;

interface TokenProviderInterface
{
    public function getAccessToken(): string;

    public function refreshAccessToken(): string;
}
