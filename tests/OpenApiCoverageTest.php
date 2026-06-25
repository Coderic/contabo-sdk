<?php

declare(strict_types=1);

namespace Contabo\Tests;

use Contabo\ApiResourceProxy;
use Contabo\ContaboClient;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

final class OpenApiCoverageTest extends TestCase
{
    public function test_vendored_openapi_spec_matches_expected_current_surface(): void
    {
        $spec = (string) file_get_contents(__DIR__.'/../openapi/openapi.yaml');

        self::assertSame(90, preg_match_all('/^  \/v1\//m', $spec));
        self::assertSame(169, preg_match_all('/^    (get|post|put|patch|delete):/m', $spec));
        self::assertStringContainsString('openapi: 3.0.3', $spec);
        self::assertStringContainsString('version: 1.0.0', $spec);
    }

    public function test_generated_client_contains_all_primary_api_groups(): void
    {
        $expectedApis = [
            'InstancesApi',
            'InstanceActionsApi',
            'ImagesApi',
            'SnapshotsApi',
            'ObjectStoragesApi',
            'PrivateNetworksApi',
            'UsersApi',
            'RolesApi',
            'TagsApi',
            'TagAssignmentsApi',
            'SecretsApi',
            'VIPApi',
            'DomainsApi',
            'HandlesApi',
            'DNSApi',
            'FirewallsApi',
            'ChecksApi',
            'CheckCollectionsApi',
            'RemediesApi',
        ];

        foreach ($expectedApis as $api) {
            self::assertFileExists(__DIR__."/../src/Generated/lib/Api/{$api}.php");
        }
    }

    public function test_contabo_client_exposes_all_public_resource_accessors(): void
    {
        $reflection = new ReflectionClass(ContaboClient::class);
        $accessors = [];

        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->isStatic() || $method->getName() === 'resource') {
                continue;
            }

            if ($method->getReturnType()?->getName() === ApiResourceProxy::class) {
                $accessors[] = $method->getName();
            }
        }

        sort($accessors);

        self::assertSame([
            'checkCollections',
            'checks',
            'dns',
            'dnsAudits',
            'domains',
            'domainsAudits',
            'firewalls',
            'firewallsAudits',
            'handles',
            'handlesAudits',
            'images',
            'imagesAudits',
            'instanceActions',
            'instanceActionsAudits',
            'instances',
            'instancesAudits',
            'objectStorages',
            'objectStoragesAudits',
            'privateNetworks',
            'privateNetworksAudits',
            'remedies',
            'roles',
            'rolesAudits',
            'secrets',
            'secretsAudits',
            'snapshots',
            'snapshotsAudits',
            'tagAssignments',
            'tagAssignmentsAudits',
            'tags',
            'tagsAudits',
            'users',
            'usersAudits',
            'usersObjectStorageCredentials',
            'vip',
            'vipAudits',
        ], $accessors);
    }

    public function test_generated_api_count_matches_openapi_operations(): void
    {
        $apiFiles = glob(__DIR__.'/../src/Generated/lib/Api/*Api.php') ?: [];

        self::assertCount(48, $apiFiles);
    }

    public function test_scripts_exist_for_openapi_maintenance(): void
    {
        self::assertFileExists(__DIR__.'/../scripts/sync-openapi.sh');
        self::assertFileExists(__DIR__.'/../scripts/generate-client.sh');
        self::assertFileExists(__DIR__.'/../scripts/diff-openapi.sh');
    }
}
