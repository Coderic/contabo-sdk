<?php

declare(strict_types=1);

namespace Coderic\Contabo\Tests\Support;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

final class MockHttp
{
    /**
     * @param  array<int, Response>  $responses
     */
    public static function client(array $responses): MockHttpClient
    {
        return new MockHttpClient($responses);
    }

    public static function tokenResponse(string $token = 'access-token-1', int $expiresIn = 3600): Response
    {
        return new Response(200, ['Content-Type' => 'application/json'], json_encode([
            'access_token' => $token,
            'expires_in' => $expiresIn,
            'token_type' => 'Bearer',
        ], JSON_THROW_ON_ERROR));
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public static function jsonResponse(array $payload = ['data' => []]): Response
    {
        return new Response(200, ['Content-Type' => 'application/json'], json_encode($payload, JSON_THROW_ON_ERROR));
    }
}

final class MockHttpClient
{
    /** @var array<int, array{request: RequestInterface}> */
    public array $history = [];

    public readonly Client $client;

    /**
     * @param  array<int, Response>  $responses
     */
    public function __construct(array $responses)
    {
        $mock = new MockHandler($responses);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($this->history));

        $this->client = new Client(['handler' => $stack]);
    }
}
