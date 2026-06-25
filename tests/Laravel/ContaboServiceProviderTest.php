<?php

declare(strict_types=1);

namespace Coderic\Contabo\Tests\Laravel;

use Coderic\Contabo\ContaboClient;
use Coderic\Contabo\Laravel\ContaboServiceProvider;
use Coderic\Contabo\Laravel\Facades\Contabo;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

final class ContaboServiceProviderTest extends TestCase
{
    /**
     * @param  Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [ContaboServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('contabo.client_id', 'client-id');
        $app['config']->set('contabo.client_secret', 'client-secret');
        $app['config']->set('contabo.api_user', 'api@example.com');
        $app['config']->set('contabo.api_password', 'api-password');
    }

    public function test_registers_contabo_client_singleton(): void
    {
        $client = $this->app->make(ContaboClient::class);

        self::assertInstanceOf(ContaboClient::class, $client);
        self::assertSame($client, $this->app->make('contabo'));
    }

    public function test_facade_resolves_registered_client(): void
    {
        self::assertInstanceOf(ContaboClient::class, Contabo::getFacadeRoot());
    }

    public function test_merges_default_configuration(): void
    {
        self::assertSame('https://api.contabo.com', config('contabo.api_url'));
        self::assertSame(
            'https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token',
            config('contabo.auth_url')
        );
    }

    public function test_publishes_contabo_config_tag(): void
    {
        $this->artisan('vendor:publish', [
            '--provider' => ContaboServiceProvider::class,
            '--tag' => 'contabo-config',
            '--force' => true,
        ])->assertExitCode(0);

        self::assertFileExists(config_path('contabo.php'));
    }
}
