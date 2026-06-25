<?php

declare(strict_types=1);

namespace Contabo\Tests\Auth;

use Contabo\Auth\Credentials;
use Contabo\Auth\OAuthTokenProvider;
use Contabo\Tests\Support\MockHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class OAuthTokenProviderTest extends TestCase
{
    public function test_fetches_access_token_with_password_grant(): void
    {
        $history = [];
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'access_token' => 'access-token-1',
                'refresh_token' => 'refresh-token-1',
                'expires_in' => 3600,
                'token_type' => 'Bearer',
            ], JSON_THROW_ON_ERROR)),
        ]);

        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));

        $provider = new OAuthTokenProvider(
            new Credentials('client-id', 'client-secret', 'api@example.com', 'api-password'),
            new Client(['handler' => $stack])
        );

        self::assertSame('access-token-1', $provider->getAccessToken());
        self::assertCount(1, $history);
        self::assertSame('POST', $history[0]['request']->getMethod());
        self::assertSame('/auth/realms/contabo/protocol/openid-connect/token', $history[0]['request']->getUri()->getPath());
        self::assertStringContainsString('grant_type=password', (string) $history[0]['request']->getBody());
        self::assertStringContainsString('client_id=client-id', (string) $history[0]['request']->getBody());
    }

    public function test_reuses_cached_token_until_forced_refresh(): void
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], '{"access_token":"access-token-1","expires_in":3600}'),
            new Response(200, ['Content-Type' => 'application/json'], '{"access_token":"access-token-2","expires_in":3600}'),
        ]);

        $provider = new OAuthTokenProvider(
            new Credentials('client-id', 'client-secret', 'api@example.com', 'api-password'),
            new Client(['handler' => HandlerStack::create($mock)])
        );

        self::assertSame('access-token-1', $provider->getAccessToken());
        self::assertSame('access-token-1', $provider->getAccessToken());
        self::assertSame('access-token-2', $provider->refreshAccessToken());
    }

    public function test_refetches_token_when_cached_token_is_expired(): void
    {
        $mock = new MockHandler([
            MockHttp::tokenResponse('access-token-1', expiresIn: 0),
            MockHttp::tokenResponse('access-token-2', expiresIn: 3600),
        ]);

        $provider = new OAuthTokenProvider(
            new Credentials('client-id', 'client-secret', 'api@example.com', 'api-password'),
            new Client(['handler' => HandlerStack::create($mock)])
        );

        self::assertSame('access-token-1', $provider->getAccessToken());
        self::assertSame('access-token-2', $provider->getAccessToken());
    }

    public function test_uses_custom_auth_url(): void
    {
        $history = [];
        $mock = new MockHandler([MockHttp::tokenResponse()]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));

        $provider = new OAuthTokenProvider(
            new Credentials('client-id', 'client-secret', 'api@example.com', 'api-password'),
            new Client(['handler' => $stack]),
            authUrl: 'https://auth.example.test/custom/token'
        );

        $provider->getAccessToken();

        self::assertSame('auth.example.test', $history[0]['request']->getUri()->getHost());
        self::assertSame('/custom/token', $history[0]['request']->getUri()->getPath());
    }
}
