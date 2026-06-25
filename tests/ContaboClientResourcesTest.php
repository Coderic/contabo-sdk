<?php

declare(strict_types=1);

namespace Coderic\Contabo\Tests;

use Coderic\Contabo\ApiResourceProxy;
use Coderic\Contabo\Auth\Credentials;
use Coderic\Contabo\ContaboClient;
use Coderic\Contabo\Tests\Support\MockHttp;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ContaboClientResourcesTest extends TestCase
{
    /**
     * @return array<string, array{0: string, 1: string, 2: string}>
     */
    public static function moduleListEndpointsProvider(): array
    {
        return [
            'compute instances' => ['instances', 'retrieveInstancesList', '/v1/compute/instances'],
            'compute images' => ['images', 'retrieveImageList', '/v1/compute/images'],
            'object storages' => ['objectStorages', 'retrieveObjectStorageList', '/v1/object-storages'],
            'private networks' => ['privateNetworks', 'retrievePrivateNetworkList', '/v1/private-networks'],
            'users' => ['users', 'retrieveUserList', '/v1/users'],
            'roles' => ['roles', 'retrieveRoleList', '/v1/roles'],
            'tags' => ['tags', 'retrieveTagList', '/v1/tags'],
            'secrets' => ['secrets', 'retrieveSecretList', '/v1/secrets'],
            'vip' => ['vip', 'retrieveVipList', '/v1/vips'],
            'domains' => ['domains', 'listDomains', '/v1/domains'],
            'handles' => ['handles', 'listHandles', '/v1/domains/handles'],
            'dns zones' => ['dns', 'retrieveDnsZonesList', '/v1/dns/zones'],
            'firewalls' => ['firewalls', 'retrieveFirewallList', '/v1/firewalls'],
            'checks' => ['checks', 'listExtChecks', '/v1/troubleshooting/checks'],
            'check collections' => ['checkCollections', 'listExtCheckCollections', '/v1/troubleshooting/check-collections'],
            'remedies' => ['remedies', 'listExtRemedies', '/v1/troubleshooting/remedies'],
        ];
    }

    /**
     * @return array<string, array{0: string}>
     */
    public static function resourceAccessorsProvider(): array
    {
        return array_map(
            static fn (array $case): array => [$case[0]],
            self::moduleListEndpointsProvider()
        );
    }

    #[DataProvider('resourceAccessorsProvider')]
    public function test_resource_accessors_return_cached_proxy(string $accessor): void
    {
        $client = $this->client();

        $first = $client->{$accessor}();
        $second = $client->{$accessor}();

        self::assertInstanceOf(ApiResourceProxy::class, $first);
        self::assertSame($first, $second);
    }

    #[DataProvider('moduleListEndpointsProvider')]
    public function test_module_list_endpoints_call_expected_path(string $accessor, string $method, string $path): void
    {
        $mock = MockHttp::client([
            MockHttp::tokenResponse(),
            MockHttp::jsonResponse(['data' => [], '_pagination' => [], '_links' => []]),
        ]);

        $client = ContaboClient::fromCredentials(
            new Credentials('client-id', 'client-secret', 'api@example.com', 'api-password'),
            httpClient: $mock->client,
        );

        $client->{$accessor}()->{$method}();

        self::assertCount(2, $mock->history);
        self::assertSame($path, $mock->history[1]['request']->getUri()->getPath());
        self::assertSame('GET', $mock->history[1]['request']->getMethod());
    }

    public function test_from_credentials_uses_custom_api_and_trace_headers(): void
    {
        $mock = MockHttp::client([
            MockHttp::tokenResponse(),
            MockHttp::jsonResponse(['data' => [], '_pagination' => [], '_links' => []]),
        ]);

        $client = ContaboClient::fromCredentials(
            new Credentials('client-id', 'client-secret', 'api@example.com', 'api-password'),
            httpClient: $mock->client,
            apiUrl: 'https://api.example.test',
            traceId: 'coderic-test-trace',
        );

        $client->instances()->retrieveInstancesList();

        self::assertSame('api.example.test', $mock->history[1]['request']->getUri()->getHost());
        self::assertSame('coderic-test-trace', $mock->history[1]['request']->getHeaderLine('x-trace-id'));
    }

    private function client(): ContaboClient
    {
        $mock = MockHttp::client([
            MockHttp::tokenResponse(),
        ]);

        return ContaboClient::fromCredentials(
            new Credentials('client-id', 'client-secret', 'api@example.com', 'api-password'),
            httpClient: $mock->client,
        );
    }
}
