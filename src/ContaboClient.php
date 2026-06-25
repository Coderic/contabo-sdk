<?php

declare(strict_types=1);

namespace Contabo;

use Contabo\Auth\Credentials;
use Contabo\Auth\OAuthTokenProvider;
use Contabo\Auth\TokenProviderInterface;
use Contabo\Generated\Api\CheckCollectionsApi;
use Contabo\Generated\Api\ChecksApi;
use Contabo\Generated\Api\DNSApi;
use Contabo\Generated\Api\DNSAuditsApi;
use Contabo\Generated\Api\DomainsApi;
use Contabo\Generated\Api\DomainsAuditsApi;
use Contabo\Generated\Api\FirewallsApi;
use Contabo\Generated\Api\FirewallsAuditsApi;
use Contabo\Generated\Api\HandlesApi;
use Contabo\Generated\Api\HandlesAuditsApi;
use Contabo\Generated\Api\ImagesApi;
use Contabo\Generated\Api\ImagesAuditsApi;
use Contabo\Generated\Api\InstanceActionsApi;
use Contabo\Generated\Api\InstanceActionsAuditsApi;
use Contabo\Generated\Api\InstancesApi;
use Contabo\Generated\Api\InstancesAuditsApi;
use Contabo\Generated\Api\ObjectStoragesApi;
use Contabo\Generated\Api\ObjectStoragesAuditsApi;
use Contabo\Generated\Api\PrivateNetworksApi;
use Contabo\Generated\Api\PrivateNetworksAuditsApi;
use Contabo\Generated\Api\RemediesApi;
use Contabo\Generated\Api\RolesApi;
use Contabo\Generated\Api\RolesAuditsApi;
use Contabo\Generated\Api\SecretsApi;
use Contabo\Generated\Api\SecretsAuditsApi;
use Contabo\Generated\Api\SnapshotsApi;
use Contabo\Generated\Api\SnapshotsAuditsApi;
use Contabo\Generated\Api\TagAssignmentsApi;
use Contabo\Generated\Api\TagAssignmentsAuditsApi;
use Contabo\Generated\Api\TagsApi;
use Contabo\Generated\Api\TagsAuditsApi;
use Contabo\Generated\Api\UsersApi;
use Contabo\Generated\Api\UsersAuditsApi;
use Contabo\Generated\Api\UsersObjectStorageCredentialsApi;
use Contabo\Generated\Api\VIPApi;
use Contabo\Generated\Api\VipAuditsApi;
use Contabo\Generated\Configuration as GeneratedConfiguration;
use Contabo\Generated\HeaderSelector;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

final class ContaboClient
{
    public const DEFAULT_API_URL = 'https://api.contabo.com';

    /** @var array<class-string, ApiResourceProxy> */
    private array $resources = [];

    public function __construct(
        private readonly TokenProviderInterface $tokenProvider,
        private readonly ClientInterface $httpClient,
        private readonly GeneratedConfiguration $configuration,
        private readonly ?string $traceId = null,
    ) {}

    public static function fromCredentials(
        Credentials $credentials,
        ?ClientInterface $httpClient = null,
        string $apiUrl = self::DEFAULT_API_URL,
        string $authUrl = OAuthTokenProvider::DEFAULT_AUTH_URL,
        ?string $traceId = null,
    ): self {
        $httpClient ??= new Client;
        $configuration = (new GeneratedConfiguration)->setHost($apiUrl);
        $tokenProvider = new OAuthTokenProvider($credentials, $httpClient, $authUrl);

        return new self($tokenProvider, $httpClient, $configuration, $traceId);
    }

    public function instances(): ApiResourceProxy
    {
        return $this->resource(InstancesApi::class);
    }

    public function instanceActions(): ApiResourceProxy
    {
        return $this->resource(InstanceActionsApi::class);
    }

    public function instanceActionsAudits(): ApiResourceProxy
    {
        return $this->resource(InstanceActionsAuditsApi::class);
    }

    public function instancesAudits(): ApiResourceProxy
    {
        return $this->resource(InstancesAuditsApi::class);
    }

    public function images(): ApiResourceProxy
    {
        return $this->resource(ImagesApi::class);
    }

    public function imagesAudits(): ApiResourceProxy
    {
        return $this->resource(ImagesAuditsApi::class);
    }

    public function snapshots(): ApiResourceProxy
    {
        return $this->resource(SnapshotsApi::class);
    }

    public function snapshotsAudits(): ApiResourceProxy
    {
        return $this->resource(SnapshotsAuditsApi::class);
    }

    public function objectStorages(): ApiResourceProxy
    {
        return $this->resource(ObjectStoragesApi::class);
    }

    public function objectStoragesAudits(): ApiResourceProxy
    {
        return $this->resource(ObjectStoragesAuditsApi::class);
    }

    public function privateNetworks(): ApiResourceProxy
    {
        return $this->resource(PrivateNetworksApi::class);
    }

    public function privateNetworksAudits(): ApiResourceProxy
    {
        return $this->resource(PrivateNetworksAuditsApi::class);
    }

    public function users(): ApiResourceProxy
    {
        return $this->resource(UsersApi::class);
    }

    public function usersAudits(): ApiResourceProxy
    {
        return $this->resource(UsersAuditsApi::class);
    }

    public function usersObjectStorageCredentials(): ApiResourceProxy
    {
        return $this->resource(UsersObjectStorageCredentialsApi::class);
    }

    public function roles(): ApiResourceProxy
    {
        return $this->resource(RolesApi::class);
    }

    public function rolesAudits(): ApiResourceProxy
    {
        return $this->resource(RolesAuditsApi::class);
    }

    public function tags(): ApiResourceProxy
    {
        return $this->resource(TagsApi::class);
    }

    public function tagsAudits(): ApiResourceProxy
    {
        return $this->resource(TagsAuditsApi::class);
    }

    public function tagAssignments(): ApiResourceProxy
    {
        return $this->resource(TagAssignmentsApi::class);
    }

    public function tagAssignmentsAudits(): ApiResourceProxy
    {
        return $this->resource(TagAssignmentsAuditsApi::class);
    }

    public function secrets(): ApiResourceProxy
    {
        return $this->resource(SecretsApi::class);
    }

    public function secretsAudits(): ApiResourceProxy
    {
        return $this->resource(SecretsAuditsApi::class);
    }

    public function vip(): ApiResourceProxy
    {
        return $this->resource(VIPApi::class);
    }

    public function vipAudits(): ApiResourceProxy
    {
        return $this->resource(VipAuditsApi::class);
    }

    public function domains(): ApiResourceProxy
    {
        return $this->resource(DomainsApi::class);
    }

    public function domainsAudits(): ApiResourceProxy
    {
        return $this->resource(DomainsAuditsApi::class);
    }

    public function handles(): ApiResourceProxy
    {
        return $this->resource(HandlesApi::class);
    }

    public function handlesAudits(): ApiResourceProxy
    {
        return $this->resource(HandlesAuditsApi::class);
    }

    public function dns(): ApiResourceProxy
    {
        return $this->resource(DNSApi::class);
    }

    public function dnsAudits(): ApiResourceProxy
    {
        return $this->resource(DNSAuditsApi::class);
    }

    public function firewalls(): ApiResourceProxy
    {
        return $this->resource(FirewallsApi::class);
    }

    public function firewallsAudits(): ApiResourceProxy
    {
        return $this->resource(FirewallsAuditsApi::class);
    }

    public function checks(): ApiResourceProxy
    {
        return $this->resource(ChecksApi::class);
    }

    public function checkCollections(): ApiResourceProxy
    {
        return $this->resource(CheckCollectionsApi::class);
    }

    public function remedies(): ApiResourceProxy
    {
        return $this->resource(RemediesApi::class);
    }

    /**
     * @template T of object
     *
     * @param  class-string<T>  $apiClass
     */
    public function resource(string $apiClass): ApiResourceProxy
    {
        return $this->resources[$apiClass] ??= new ApiResourceProxy(
            new $apiClass($this->httpClient, $this->configuration, new HeaderSelector),
            $this->tokenProvider,
            $this->configuration,
            $this->traceId,
        );
    }
}
