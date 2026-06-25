<?php

declare(strict_types=1);

namespace Coderic\Contabo\Tests;

use Coderic\Contabo\ApiResourceProxy;
use Coderic\Contabo\Auth\TokenProviderInterface;
use Coderic\Contabo\Generated\ApiException;
use Coderic\Contabo\Generated\Configuration as GeneratedConfiguration;
use PHPUnit\Framework\TestCase;

final class ApiResourceProxyTest extends TestCase
{
    public function test_injects_trace_id_when_configured(): void
    {
        $proxy = $this->proxy(traceId: 'trace-123');

        self::assertMatchesRegularExpression(
            '/^[0-9a-fA-F-]{36}\|trace-123$/',
            $proxy->ping()
        );
    }

    public function test_preserves_explicit_request_id_and_trace_id(): void
    {
        $proxy = $this->proxy(traceId: 'ignored-trace');

        self::assertSame(
            '04e0f898-37b4-48bc-a794-1a57abe6aa31|custom-trace',
            $proxy->ping('04e0f898-37b4-48bc-a794-1a57abe6aa31', 'custom-trace')
        );
    }

    public function test_does_not_retry_non_unauthorized_errors(): void
    {
        $proxy = $this->proxy(throwStatus: 403);

        $this->expectException(ApiException::class);
        $this->expectExceptionCode(403);

        $proxy->ping();
    }

    public function test_refreshes_token_and_retries_on_unauthorized(): void
    {
        $tokens = new class implements TokenProviderInterface
        {
            public int $refreshCalls = 0;

            public function getAccessToken(): string
            {
                return 'access-token-1';
            }

            public function refreshAccessToken(): string
            {
                $this->refreshCalls++;

                return 'access-token-2';
            }
        };

        $proxy = new ApiResourceProxy(
            new StubApi(throwOnceWithStatus: 401),
            $tokens,
            new GeneratedConfiguration,
        );

        self::assertMatchesRegularExpression(
            '/^[0-9a-fA-F-]{36}\|$/',
            $proxy->ping()
        );
        self::assertSame(1, $tokens->refreshCalls);
    }

    private function proxy(?string $traceId = null, ?int $throwStatus = null): ApiResourceProxy
    {
        return new ApiResourceProxy(
            new StubApi($throwStatus),
            new StubTokenProvider,
            new GeneratedConfiguration,
            $traceId,
        );
    }
}

final class StubApi
{
    private bool $alreadyFailed = false;

    public function __construct(
        private readonly ?int $throwOnceWithStatus = null,
    ) {}

    public function ping(string $xRequestId, ?string $xTraceId = null): string
    {
        if ($this->throwOnceWithStatus !== null && ! $this->alreadyFailed) {
            $this->alreadyFailed = true;

            throw new ApiException('Error', $this->throwOnceWithStatus);
        }

        return $xRequestId.'|'.($xTraceId ?? '');
    }
}

final class StubTokenProvider implements TokenProviderInterface
{
    public function getAccessToken(): string
    {
        return 'access-token';
    }

    public function refreshAccessToken(): string
    {
        return 'access-token-refreshed';
    }
}
