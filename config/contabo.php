<?php

declare(strict_types=1);

use Coderic\Contabo\Auth\OAuthTokenProvider;
use Coderic\Contabo\ContaboClient;

return [
    'client_id' => env('CONTABO_CLIENT_ID'),
    'client_secret' => env('CONTABO_CLIENT_SECRET'),
    'api_user' => env('CONTABO_API_USER'),
    'api_password' => env('CONTABO_API_PASSWORD'),
    'api_url' => env('CONTABO_API_URL', ContaboClient::DEFAULT_API_URL),
    'auth_url' => env('CONTABO_AUTH_URL', OAuthTokenProvider::DEFAULT_AUTH_URL),
    'trace_id' => env('CONTABO_TRACE_ID'),
];
