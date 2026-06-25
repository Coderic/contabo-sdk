<?php

declare(strict_types=1);

namespace Contabo\Auth;

final class Token
{
    private const EXPIRY_SKEW_SECONDS = 60;

    public function __construct(
        private readonly string $accessToken,
        private readonly ?string $refreshToken,
        private readonly int $expiresAt,
    ) {}

    /**
     * @param  array{access_token?: string, refresh_token?: string, expires_in?: int}  $payload
     */
    public static function fromArray(array $payload, int $issuedAt): self
    {
        if (! isset($payload['access_token']) || $payload['access_token'] === '') {
            throw new \UnexpectedValueException('La respuesta OAuth no incluye access_token.');
        }

        $expiresIn = (int) ($payload['expires_in'] ?? 3600);

        return new self(
            $payload['access_token'],
            $payload['refresh_token'] ?? null,
            $issuedAt + $expiresIn
        );
    }

    public function accessToken(): string
    {
        return $this->accessToken;
    }

    public function refreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function isExpired(?int $now = null): bool
    {
        return ($now ?? time()) >= ($this->expiresAt - self::EXPIRY_SKEW_SECONDS);
    }
}
