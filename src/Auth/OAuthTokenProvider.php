<?php

declare(strict_types=1);

namespace Contabo\Auth;

use GuzzleHttp\ClientInterface;

final class OAuthTokenProvider implements TokenProviderInterface
{
    public const DEFAULT_AUTH_URL = 'https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token';

    private ?Token $token = null;

    public function __construct(
        private readonly Credentials $credentials,
        private readonly ClientInterface $httpClient,
        private readonly string $authUrl = self::DEFAULT_AUTH_URL,
    ) {}

    public function getAccessToken(): string
    {
        if ($this->token === null || $this->token->isExpired()) {
            $this->token = $this->requestPasswordGrantToken();
        }

        return $this->token->accessToken();
    }

    public function refreshAccessToken(): string
    {
        $this->token = $this->requestPasswordGrantToken();

        return $this->token->accessToken();
    }

    private function requestPasswordGrantToken(): Token
    {
        $issuedAt = time();
        $response = $this->httpClient->request('POST', $this->authUrl, [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $this->credentials->clientId,
                'client_secret' => $this->credentials->clientSecret,
                'username' => $this->credentials->apiUser,
                'password' => $this->credentials->apiPassword,
            ],
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        /** @var array{access_token?: string, refresh_token?: string, expires_in?: int} $payload */
        $payload = json_decode((string) $response->getBody(), true, flags: JSON_THROW_ON_ERROR);

        return Token::fromArray($payload, $issuedAt);
    }
}
