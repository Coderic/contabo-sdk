<?php

declare(strict_types=1);

namespace Coderic\Contabo;

use Coderic\Contabo\Auth\Credentials;
use Coderic\Contabo\Auth\OAuthTokenProvider;
use Coderic\Contabo\Auth\TokenProviderInterface;
use Coderic\Contabo\Generated\Api\CheckCollectionsApi;
use Coderic\Contabo\Generated\Api\ChecksApi;
use Coderic\Contabo\Generated\Api\DNSApi;
use Coderic\Contabo\Generated\Api\DNSAuditsApi;
use Coderic\Contabo\Generated\Api\DomainsApi;
use Coderic\Contabo\Generated\Api\DomainsAuditsApi;
use Coderic\Contabo\Generated\Api\FirewallsApi;
use Coderic\Contabo\Generated\Api\FirewallsAuditsApi;
use Coderic\Contabo\Generated\Api\HandlesApi;
use Coderic\Contabo\Generated\Api\HandlesAuditsApi;
use Coderic\Contabo\Generated\Api\ImagesApi;
use Coderic\Contabo\Generated\Api\ImagesAuditsApi;
use Coderic\Contabo\Generated\Api\InstanceActionsApi;
use Coderic\Contabo\Generated\Api\InstanceActionsAuditsApi;
use Coderic\Contabo\Generated\Api\InstancesApi;
use Coderic\Contabo\Generated\Api\InstancesAuditsApi;
use Coderic\Contabo\Generated\Api\ObjectStoragesApi;
use Coderic\Contabo\Generated\Api\ObjectStoragesAuditsApi;
use Coderic\Contabo\Generated\Api\PrivateNetworksApi;
use Coderic\Contabo\Generated\Api\PrivateNetworksAuditsApi;
use Coderic\Contabo\Generated\Api\RemediesApi;
use Coderic\Contabo\Generated\Api\RolesApi;
use Coderic\Contabo\Generated\Api\RolesAuditsApi;
use Coderic\Contabo\Generated\Api\SecretsApi;
use Coderic\Contabo\Generated\Api\SecretsAuditsApi;
use Coderic\Contabo\Generated\Api\SnapshotsApi;
use Coderic\Contabo\Generated\Api\SnapshotsAuditsApi;
use Coderic\Contabo\Generated\Api\TagAssignmentsApi;
use Coderic\Contabo\Generated\Api\TagAssignmentsAuditsApi;
use Coderic\Contabo\Generated\Api\TagsApi;
use Coderic\Contabo\Generated\Api\TagsAuditsApi;
use Coderic\Contabo\Generated\Api\UsersApi;
use Coderic\Contabo\Generated\Api\UsersAuditsApi;
use Coderic\Contabo\Generated\Api\UsersObjectStorageCredentialsApi;
use Coderic\Contabo\Generated\Api\VIPApi;
use Coderic\Contabo\Generated\Api\VipAuditsApi;
use Coderic\Contabo\Generated\Configuration as GeneratedConfiguration;
use Coderic\Contabo\Generated\HeaderSelector;
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
