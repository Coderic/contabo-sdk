<?php

declare(strict_types=1);

namespace Contabo\Auth;

final readonly class Credentials
{
    public function __construct(
        public string $clientId,
        public string $clientSecret,
        public string $apiUser,
        public string $apiPassword,
    ) {}
}
