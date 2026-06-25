<?php

declare(strict_types=1);

namespace Contabo\Tests;

use Contabo\Auth\Credentials;
use Contabo\ContaboClient;
use Contabo\Tests\Support\MockHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class ContaboClientTest extends TestCase
{
    public function test_generated_api_calls_receive_token_and_request_id_automatically(): void
    {
        $mock = MockHttp::client([
            MockHttp::tokenResponse(),
            MockHttp::jsonResponse(['data' => [], '_pagination' => [], '_links' => []]),
        ]);

        $client = ContaboClient::fromCredentials(
            new Credentials('client-id', 'client-secret', 'api@example.com', 'api-password'),
            httpClient: $mock->client,
        );

        $client->instances()->retrieveInstancesList();

        self::assertCount(2, $mock->history);
        self::assertSame('/v1/compute/instances', $mock->history[1]['request']->getUri()->getPath());
        self::assertSame('Bearer access-token-1', $mock->history[1]['request']->getHeaderLine('Authorization'));
        self::assertMatchesRegularExpression(
            '/^[0-9a-fA-F-]{36}$/',
            $mock->history[1]['request']->getHeaderLine('x-request-id')
        );
    }

    public function test_preserves_explicit_request_id_when_provided(): void
    {
        $mock = MockHttp::client([
            MockHttp::tokenResponse(),
            MockHttp::jsonResponse(['data' => [], '_pagination' => [], '_links' => []]),
        ]);

        $client = ContaboClient::fromCredentials(
            new Credentials('client-id', 'client-secret', 'api@example.com', 'api-password'),
            httpClient: $mock->client,
        );

        $requestId = '04e0f898-37b4-48bc-a794-1a57abe6aa31';
        $client->instances()->retrieveInstancesList($requestId);

        self::assertSame($requestId, $mock->history[1]['request']->getHeaderLine('x-request-id'));
    }

    public function test_refreshes_token_and_retries_once_after_unauthorized_response(): void
    {
        $history = [];
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], '{"access_token":"access-token-1","expires_in":3600}'),
            new Response(401, ['Content-Type' => 'application/json'], '{"message":"Unauthorized"}'),
            new Response(200, ['Content-Type' => 'application/json'], '{"access_token":"access-token-2","expires_in":3600}'),
            new Response(200, ['Content-Type' => 'application/json'], '{"data":[],"_pagination":{},"_links":{}}'),
        ]);

        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));

        $client = ContaboClient::fromCredentials(
            new Credentials('client-id', 'client-secret', 'api@example.com', 'api-password'),
            httpClient: new Client(['handler' => $stack])
        );

        $client->instances()->retrieveInstancesList();

        self::assertCount(4, $history);
        self::assertSame('Bearer access-token-1', $history[1]['request']->getHeaderLine('Authorization'));
        self::assertSame('Bearer access-token-2', $history[3]['request']->getHeaderLine('Authorization'));
    }
}
