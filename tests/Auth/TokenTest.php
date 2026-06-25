<?php

declare(strict_types=1);

namespace Coderic\Contabo\Tests\Auth;

use Coderic\Contabo\Auth\Token;
use PHPUnit\Framework\TestCase;

final class TokenTest extends TestCase
{
    public function test_from_array_builds_token_with_expiration(): void
    {
        $token = Token::fromArray([
            'access_token' => 'access-token',
            'refresh_token' => 'refresh-token',
            'expires_in' => 3600,
        ], 1_700_000_000);

        self::assertSame('access-token', $token->accessToken());
        self::assertSame('refresh-token', $token->refreshToken());
        self::assertFalse($token->isExpired(1_700_000_000));
        self::assertFalse($token->isExpired(1_700_003_539));
        self::assertTrue($token->isExpired(1_700_003_540));
    }

    public function test_from_array_requires_access_token(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage('access_token');

        Token::fromArray([], 1_700_000_000);
    }

    public function test_from_array_defaults_expiration_when_missing(): void
    {
        $token = Token::fromArray(['access_token' => 'access-token'], 1_700_000_000);

        self::assertNull($token->refreshToken());
        self::assertFalse($token->isExpired(1_700_003_539));
        self::assertTrue($token->isExpired(1_700_003_540));
    }
}
