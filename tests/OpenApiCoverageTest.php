<?php

declare(strict_types=1);

namespace Coderic\Contabo\Tests;

use PHPUnit\Framework\TestCase;

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
}
