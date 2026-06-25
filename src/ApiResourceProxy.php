<?php

declare(strict_types=1);

namespace Contabo;

use Contabo\Auth\TokenProviderInterface;
use Contabo\Generated\ApiException;
use Contabo\Generated\Configuration as GeneratedConfiguration;

final class ApiResourceProxy
{
    /**
     * @param  object  $api  Generated API resource.
     */
    public function __construct(
        private readonly object $api,
        private readonly TokenProviderInterface $tokenProvider,
        private readonly GeneratedConfiguration $configuration,
        private readonly ?string $traceId = null,
    ) {}

    /**
     * @param  array<int|string, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        $arguments = $this->withRequestHeaders($arguments);

        try {
            $this->configuration->setAccessToken($this->tokenProvider->getAccessToken());

            return $this->api->{$method}(...$arguments);
        } catch (ApiException $exception) {
            if ($exception->getCode() !== 401) {
                throw $exception;
            }

            $this->configuration->setAccessToken($this->tokenProvider->refreshAccessToken());

            return $this->api->{$method}(...$arguments);
        }
    }

    /**
     * @param  array<int|string, mixed>  $arguments
     * @return array<int|string, mixed>
     */
    private function withRequestHeaders(array $arguments): array
    {
        if (isset($arguments['xRequestId'])) {
            return $arguments;
        }

        if (isset($arguments[0]) && is_string($arguments[0]) && self::isUuid($arguments[0])) {
            return $arguments;
        }

        array_unshift($arguments, self::uuid());

        if ($this->traceId !== null && ! isset($arguments[1]) && ! isset($arguments['xTraceId'])) {
            $arguments[1] = $this->traceId;
        }

        return $arguments;
    }

    private static function isUuid(string $value): bool
    {
        return (bool) preg_match('/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/', $value);
    }

    private static function uuid(): string
    {
        $bytes = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0x0F) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3F) | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
    }
}
