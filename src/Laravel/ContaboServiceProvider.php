<?php

declare(strict_types=1);

namespace Contabo\Laravel;

use Contabo\Auth\Credentials;
use Contabo\ContaboClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

final class ContaboServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/contabo.php', 'contabo');

        $this->app->singleton(ContaboClient::class, function (Application $app): ContaboClient {
            $config = $app['config']->get('contabo');

            return ContaboClient::fromCredentials(
                new Credentials(
                    (string) $config['client_id'],
                    (string) $config['client_secret'],
                    (string) $config['api_user'],
                    (string) $config['api_password'],
                ),
                apiUrl: (string) $config['api_url'],
                authUrl: (string) $config['auth_url'],
                traceId: $config['trace_id'] !== null ? (string) $config['trace_id'] : null,
            );
        });

        $this->app->alias(ContaboClient::class, 'contabo');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/contabo.php' => config_path('contabo.php'),
        ], 'contabo-config');
    }
}
