<?php
/**
 * DNSApi
 * PHP version 7.4
 *
 * @category Class
 * @package  Contabo\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Contabo API
 *
 * # Introduction  Contabo API allows you to manage your resources using HTTP requests. This documentation includes a set of HTTP endpoints that are designed to RESTful principles. Each endpoint includes descriptions, request syntax, and examples.  Contabo provides also a CLI tool which enables you to manage your resources easily from the command line. [CLI Download and  Installation instructions.](https://github.com/contabo/cntb)  ## Product documentation  If you are looking for description about the products themselves and their usage in general or for specific purposes, please check the [Contabo Product Documentation](https://docs.contabo.com/).  ## Getting Started  In order to use the Contabo API you will need the following credentials which are available from the [Customer Control Panel](https://my.contabo.com/api/details): 1. ClientId 2. ClientSecret 3. API User (your email address to login to the [Customer Control Panel](https://my.contabo.com/api/details)) 4. API Password (this is a new password which you'll set or change in the [Customer Control Panel](https://my.contabo.com/api/details))  You can either use the API directly or by using the `cntb` CLI (Command Line Interface) tool.  ### Using the API directly  #### Via `curl` for Linux/Unix like systems  This requires `curl` and `jq` in your shell (e.g. `bash`, `zsh`). Please replace the first four placeholders with actual values.  ```sh CLIENT_ID=<ClientId from Customer Control Panel> CLIENT_SECRET=<ClientSecret from Customer Control Panel> API_USER=<API User from Customer Control Panel> API_PASSWORD='<API Password from Customer Control Panel>' ACCESS_TOKEN=$(curl -d \"client_id=$CLIENT_ID\" -d \"client_secret=$CLIENT_SECRET\" --data-urlencode \"username=$API_USER\" --data-urlencode \"password=$API_PASSWORD\" -d 'grant_type=password' 'https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token' | jq -r '.access_token') # get list of your instances curl -X GET -H \"Authorization: Bearer $ACCESS_TOKEN\" -H \"x-request-id: 51A87ECD-754E-4104-9C54-D01AD0F83406\" \"https://api.contabo.com/v1/compute/instances\" | jq ```  #### Via `PowerShell` for Windows  Please open `PowerShell` and execute the following code after replacing the first four placeholders with actual values.  ```powershell $client_id='<ClientId from Customer Control Panel>' $client_secret='<ClientSecret from Customer Control Panel>' $api_user='<API User from Customer Control Panel>' $api_password='<API Password from Customer Control Panel>' $body = @{grant_type='password' client_id=$client_id client_secret=$client_secret username=$api_user password=$api_password} $response = Invoke-WebRequest -Uri 'https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token' -Method 'POST' -Body $body $access_token = (ConvertFrom-Json $([String]::new($response.Content))).access_token # get list of your instances $headers = @{} $headers.Add(\"Authorization\",\"Bearer $access_token\") $headers.Add(\"x-request-id\",\"51A87ECD-754E-4104-9C54-D01AD0F83406\") Invoke-WebRequest -Uri 'https://api.contabo.com/v1/compute/instances' -Method 'GET' -Headers $headers ```  ### Using the Contabo API via the `cntb` CLI tool  1. Download `cntb` for your operating system (MacOS, Windows and Linux supported) [here](https://github.com/contabo/cntb) 2. Unzip the downloaded file 3. You might move the executable to any location on your disk. You may update your `PATH` environment variable for easier invocation. 4. Configure it once to use your credentials                        ```sh    cntb config set-credentials --oauth2-clientid=<ClientId from Customer Control Panel> --oauth2-client-secret=<ClientSecret from Customer Control Panel> --oauth2-user=<API User from Customer Control Panel> --oauth2-password='<API Password from Customer Control Panel>'    ```  5. Use the CLI                        ```sh    # get list of your instances    cntb get instances    # help    cntb help    ```  ## API Overview  ### [Compute Management](#tag/Instances)  The Compute Management API allows you to manage compute resources (e.g. creation, deletion, starting, stopping) of VPS and VDS (please note that Storage VPS are not supported via API or CLI) as well as managing snapshots and custom images. It also offers you to take advantage of [cloud-init](https://cloud-init.io/) at least on our default / standard images (for custom images you'll need to provide cloud-init support packages). The API offers provisioning of cloud-init scripts via the `user_data` field.  Custom images must be provided in `.qcow2` or `.iso` format. This gives you even more flexibility for setting up your environment.  ### [Object Storage](#tag/Object-Storages)  The Object Storage API allows you to order, upgrade, cancel and control the auto-scaling feature for [S3](https://en.wikipedia.org/wiki/Amazon_S3) compatible object storage. You may also get some usage statistics. You can only buy one object storage per location. In case you need more storage space in a location you can purchase more space or enable the auto-scaling feature to purchase automatically more storage space up to the specified monthly limit.  Please note that this is not the S3 compatible API. It is not documented here. The S3 compatible API needs to be used with the corresponding credentials, namely an `access_key` and `secret_key`. Those can be retrieved by invoking the User Management API. All purchased object storages in different locations share the same credentials. You are free to use S3 compatible tools like [`aws`](https://aws.amazon.com/cli/) cli or similar.  ### [Private Networking](#tag/Private-Networks)  The Private Networking API allows you to manage private networks / Virtual Private Clouds (VPC) for your Cloud VPS and VDS (please note that Storage VPS are not supported via API or CLI). Having a private network allows the associated instances to have a private and direct network connection. The traffic won't leave the data center and cannot be accessed by any other instance.  With this feature you can create multi layer systems, e.g. having a database server being only accessible from your application servers in one private network and keep the database replication in a second, separate network. This increases the speed as the traffic is NOT routed to the internet and also security as the traffic is within it's own secured VLAN.  Adding a Cloud VPS or VDS to a private network requires a reinstallation to make sure that all relevant parts for private networking are in place. When adding the same instance to another private network it will require a restart in order to make additional virtual network interface cards (NICs) available.  Please note that for each instance being part of one or several private networks a payed add-on is required. You can automatically purchase it via the Compute Management API.  ### [Secrets Management](#tag/Secrets)  You can optionally save your passwords or public ssh keys using the Secrets Management API. You are not required to use it there will be no functional disadvantages.  By using that API you can easily reuse you public ssh keys when setting up different servers without the need to look them up every time. It can also be used to allow Contabo Supporters to access your machine without sending the passwords via potentially unsecure emails.  ### [User Management](#tag/Users)  If you need to allow other persons or automation scripts to access specific API endpoints resp. resources the User Management API comes into play. With that API you are able to manage users having possibly restricted access. You are free to define those restrictions to fit your needs. So beside an arbitrary number of users you basically define any number of so called `roles`. Roles allows access and must be one of the following types:  * `apiPermission`                       This allows you to specify a restriction to certain functions of an API by allowing control over POST (=Create), GET (=Read), PUT/PATCH (=Update) and DELETE (=Delete) methods for each API endpoint (URL) individually. * `resourcePermission`                       In order to restrict access to specific resources create a role with `resourcePermission` type by specifying any number of [tags](#tag-management). These tags need to be assigned to resources for them to take effect. E.g. a tag could be assigned to several compute resources. So that a user with that role (and of course access to the API endpoints via `apiPermission` role type) could only access those compute resources.  The `roles` are then assigned to a `user`. You can assign one or several roles regardless of the role's type. Of course you could also assign a user `admin` privileges without specifying any roles.  ### [Tag Management](#tag/Tags)  The Tag Management API allows you to manage your tags in order to organize your resources in a more convenient way. Simply assign a tag to resources like a compute resource to manage them.The assignments of tags to resources will also enable you to control access to these specific resources to users via the [User Management API](#user-management). For convenience reasons you might choose a color for tag. The Customer Control Panel will use that color to display the tags.  ## Requests  The Contabo API supports HTTP requests like mentioned below. Not every endpoint supports all methods. The allowed methods are listed within this documentation.  Method | Description ---    | --- GET    | To retrieve information about a resource, use the GET method.<br>The data is returned as a JSON object. GET methods are read-only and do not affect any resources. POST   | Issue a POST method to create a new object. Include all needed attributes in the request body encoded as JSON. PATCH  | Some resources support partial modification with PATCH,<br>which modifies specific attributes without updating the entire object representation. PUT    | Use the PUT method to update information about a resource.<br>PUT will set new values on the item without regard to their current values. DELETE | Use the DELETE method to destroy a resource in your account.<br>If it is not found, the operation will return a 4xx error and an appropriate message.  ## Responses  Usually the Contabo API should respond to your requests. The data returned is in [JSON](https://www.json.org/) format allowing easy processing in any programming language or tools.  As common for HTTP requests you will get back a so called HTTP status code. This gives you overall information about success or error. The following table lists common HTTP status codes.  Please note that the description of the endpoints and methods are not listing all possibly status codes in detail as they are generic. Only special return codes with their resp. response data are explicitly listed.  Response Code | Description --- | --- 200 | The response contains your requested information. 201 | Your request was accepted. The resource was created. 204 | Your request succeeded, there is no additional information returned. 400 | Your request was malformed. 401 | You did not supply valid authentication credentials. 402 | Request refused as it requires additional payed service. 403 | You are not allowed to perform the request. 404 | No results were found for your request or resource does not exist. 409 | Conflict with resources. For example violation of unique data constraints detected when trying to create or change resources. 429 | Rate-limit reached. Please wait for some time before doing more requests. 500 | We were unable to perform the request due to server-side problems. In such cases please retry or contact the support.  Not every endpoint returns data. For example DELETE requests usually don't return any data. All others do return data. For easy handling the return values consists of metadata denoted with and underscore (\"_\") like `_links` or `_pagination`. The actual data is returned in a field called `data`. For convenience reasons this `data` field is always returned as an array even if it consists of only one single element.  Some general details about Contabo API from [Contabo](https://contabo.com).
 *
 * The version of the OpenAPI document: 1.0.0
 * Contact: support@contabo.com
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.12.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Contabo\Generated\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Contabo\Generated\ApiException;
use Contabo\Generated\Configuration;
use Contabo\Generated\HeaderSelector;
use Contabo\Generated\ObjectSerializer;

/**
 * DNSApi Class Doc Comment
 *
 * @category Class
 * @package  Contabo\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class DNSApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'bulkDeleteDnsZoneRecords' => [
            'application/json',
        ],
        'createDnsZone' => [
            'application/json',
        ],
        'createDnsZoneRecord' => [
            'application/json',
        ],
        'createPtrRecord' => [
            'application/json',
        ],
        'deleteDnsZone' => [
            'application/json',
        ],
        'deleteDnsZoneRecord' => [
            'application/json',
        ],
        'deletePtrRecord' => [
            'application/json',
        ],
        'retrieveDnsZone' => [
            'application/json',
        ],
        'retrieveDnsZoneRecordsList' => [
            'application/json',
        ],
        'retrieveDnsZonesList' => [
            'application/json',
        ],
        'retrievePtrRecord' => [
            'application/json',
        ],
        'retrievePtrRecordsList' => [
            'application/json',
        ],
        'updateDnsZoneRecord' => [
            'application/json',
        ],
        'updatePtrRecord' => [
            'application/json',
        ],
    ];

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ?ClientInterface $client = null,
        ?Configuration $config = null,
        ?HeaderSelector $selector = null,
        int $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: Configuration::getDefaultConfiguration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation bulkDeleteDnsZoneRecords
     *
     * Bulk delete DNS zone records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\BulkDeleteDnsZoneRecordsRequest $bulkDeleteDnsZoneRecordsRequest bulkDeleteDnsZoneRecordsRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['bulkDeleteDnsZoneRecords'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ApiBulkDeleteDnsZoneRecordsResponse
     */
    public function bulkDeleteDnsZoneRecords($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId = null, string $contentType = self::contentTypes['bulkDeleteDnsZoneRecords'][0])
    {
        list($response) = $this->bulkDeleteDnsZoneRecordsWithHttpInfo($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation bulkDeleteDnsZoneRecordsWithHttpInfo
     *
     * Bulk delete DNS zone records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\BulkDeleteDnsZoneRecordsRequest $bulkDeleteDnsZoneRecordsRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['bulkDeleteDnsZoneRecords'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ApiBulkDeleteDnsZoneRecordsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function bulkDeleteDnsZoneRecordsWithHttpInfo($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId = null, string $contentType = self::contentTypes['bulkDeleteDnsZoneRecords'][0])
    {
        $request = $this->bulkDeleteDnsZoneRecordsRequest($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    if ('\Contabo\Generated\Model\ApiBulkDeleteDnsZoneRecordsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ApiBulkDeleteDnsZoneRecordsResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ApiBulkDeleteDnsZoneRecordsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            $returnType = '\Contabo\Generated\Model\ApiBulkDeleteDnsZoneRecordsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Contabo\Generated\Model\ApiBulkDeleteDnsZoneRecordsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation bulkDeleteDnsZoneRecordsAsync
     *
     * Bulk delete DNS zone records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\BulkDeleteDnsZoneRecordsRequest $bulkDeleteDnsZoneRecordsRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['bulkDeleteDnsZoneRecords'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function bulkDeleteDnsZoneRecordsAsync($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId = null, string $contentType = self::contentTypes['bulkDeleteDnsZoneRecords'][0])
    {
        return $this->bulkDeleteDnsZoneRecordsAsyncWithHttpInfo($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation bulkDeleteDnsZoneRecordsAsyncWithHttpInfo
     *
     * Bulk delete DNS zone records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\BulkDeleteDnsZoneRecordsRequest $bulkDeleteDnsZoneRecordsRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['bulkDeleteDnsZoneRecords'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function bulkDeleteDnsZoneRecordsAsyncWithHttpInfo($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId = null, string $contentType = self::contentTypes['bulkDeleteDnsZoneRecords'][0])
    {
        $returnType = '\Contabo\Generated\Model\ApiBulkDeleteDnsZoneRecordsResponse';
        $request = $this->bulkDeleteDnsZoneRecordsRequest($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'bulkDeleteDnsZoneRecords'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\BulkDeleteDnsZoneRecordsRequest $bulkDeleteDnsZoneRecordsRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['bulkDeleteDnsZoneRecords'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function bulkDeleteDnsZoneRecordsRequest($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId = null, string $contentType = self::contentTypes['bulkDeleteDnsZoneRecords'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling bulkDeleteDnsZoneRecords'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.bulkDeleteDnsZoneRecords, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'zoneName' is set
        if ($zoneName === null || (is_array($zoneName) && count($zoneName) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zoneName when calling bulkDeleteDnsZoneRecords'
            );
        }

        // verify the required parameter 'bulkDeleteDnsZoneRecordsRequest' is set
        if ($bulkDeleteDnsZoneRecordsRequest === null || (is_array($bulkDeleteDnsZoneRecordsRequest) && count($bulkDeleteDnsZoneRecordsRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bulkDeleteDnsZoneRecordsRequest when calling bulkDeleteDnsZoneRecords'
            );
        }



        $resourcePath = '/v1/dns/zones/{zoneName}/records/bulk';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }

        // path params
        if ($zoneName !== null) {
            $resourcePath = str_replace(
                '{' . 'zoneName' . '}',
                ObjectSerializer::toPathValue($zoneName),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($bulkDeleteDnsZoneRecordsRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($bulkDeleteDnsZoneRecordsRequest));
            } else {
                $httpBody = $bulkDeleteDnsZoneRecordsRequest;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createDnsZone
     *
     * Create DNS zone
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateDnsZoneRequest $createDnsZoneRequest createDnsZoneRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createDnsZone'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ApiDnsZoneResponse
     */
    public function createDnsZone($xRequestId, $createDnsZoneRequest, $xTraceId = null, string $contentType = self::contentTypes['createDnsZone'][0])
    {
        list($response) = $this->createDnsZoneWithHttpInfo($xRequestId, $createDnsZoneRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation createDnsZoneWithHttpInfo
     *
     * Create DNS zone
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateDnsZoneRequest $createDnsZoneRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createDnsZone'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ApiDnsZoneResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createDnsZoneWithHttpInfo($xRequestId, $createDnsZoneRequest, $xTraceId = null, string $contentType = self::contentTypes['createDnsZone'][0])
    {
        $request = $this->createDnsZoneRequest($xRequestId, $createDnsZoneRequest, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 201:
                    if ('\Contabo\Generated\Model\ApiDnsZoneResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ApiDnsZoneResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ApiDnsZoneResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            $returnType = '\Contabo\Generated\Model\ApiDnsZoneResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Contabo\Generated\Model\ApiDnsZoneResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createDnsZoneAsync
     *
     * Create DNS zone
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateDnsZoneRequest $createDnsZoneRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createDnsZone'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createDnsZoneAsync($xRequestId, $createDnsZoneRequest, $xTraceId = null, string $contentType = self::contentTypes['createDnsZone'][0])
    {
        return $this->createDnsZoneAsyncWithHttpInfo($xRequestId, $createDnsZoneRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createDnsZoneAsyncWithHttpInfo
     *
     * Create DNS zone
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateDnsZoneRequest $createDnsZoneRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createDnsZone'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createDnsZoneAsyncWithHttpInfo($xRequestId, $createDnsZoneRequest, $xTraceId = null, string $contentType = self::contentTypes['createDnsZone'][0])
    {
        $returnType = '\Contabo\Generated\Model\ApiDnsZoneResponse';
        $request = $this->createDnsZoneRequest($xRequestId, $createDnsZoneRequest, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createDnsZone'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateDnsZoneRequest $createDnsZoneRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createDnsZone'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createDnsZoneRequest($xRequestId, $createDnsZoneRequest, $xTraceId = null, string $contentType = self::contentTypes['createDnsZone'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling createDnsZone'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.createDnsZone, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'createDnsZoneRequest' is set
        if ($createDnsZoneRequest === null || (is_array($createDnsZoneRequest) && count($createDnsZoneRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $createDnsZoneRequest when calling createDnsZone'
            );
        }



        $resourcePath = '/v1/dns/zones';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }



        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($createDnsZoneRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($createDnsZoneRequest));
            } else {
                $httpBody = $createDnsZoneRequest;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createDnsZoneRecord
     *
     * Create DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\CreateDnsZoneRecordRequest $createDnsZoneRecordRequest createDnsZoneRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ApiDnsZoneRecordResponse
     */
    public function createDnsZoneRecord($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['createDnsZoneRecord'][0])
    {
        list($response) = $this->createDnsZoneRecordWithHttpInfo($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation createDnsZoneRecordWithHttpInfo
     *
     * Create DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\CreateDnsZoneRecordRequest $createDnsZoneRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ApiDnsZoneRecordResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createDnsZoneRecordWithHttpInfo($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['createDnsZoneRecord'][0])
    {
        $request = $this->createDnsZoneRecordRequest($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 201:
                    if ('\Contabo\Generated\Model\ApiDnsZoneRecordResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ApiDnsZoneRecordResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ApiDnsZoneRecordResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            $returnType = '\Contabo\Generated\Model\ApiDnsZoneRecordResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Contabo\Generated\Model\ApiDnsZoneRecordResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createDnsZoneRecordAsync
     *
     * Create DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\CreateDnsZoneRecordRequest $createDnsZoneRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createDnsZoneRecordAsync($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['createDnsZoneRecord'][0])
    {
        return $this->createDnsZoneRecordAsyncWithHttpInfo($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createDnsZoneRecordAsyncWithHttpInfo
     *
     * Create DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\CreateDnsZoneRecordRequest $createDnsZoneRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createDnsZoneRecordAsyncWithHttpInfo($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['createDnsZoneRecord'][0])
    {
        $returnType = '\Contabo\Generated\Model\ApiDnsZoneRecordResponse';
        $request = $this->createDnsZoneRecordRequest($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createDnsZoneRecord'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\CreateDnsZoneRecordRequest $createDnsZoneRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createDnsZoneRecordRequest($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['createDnsZoneRecord'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling createDnsZoneRecord'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.createDnsZoneRecord, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'zoneName' is set
        if ($zoneName === null || (is_array($zoneName) && count($zoneName) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zoneName when calling createDnsZoneRecord'
            );
        }

        // verify the required parameter 'createDnsZoneRecordRequest' is set
        if ($createDnsZoneRecordRequest === null || (is_array($createDnsZoneRecordRequest) && count($createDnsZoneRecordRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $createDnsZoneRecordRequest when calling createDnsZoneRecord'
            );
        }



        $resourcePath = '/v1/dns/zones/{zoneName}/records';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }

        // path params
        if ($zoneName !== null) {
            $resourcePath = str_replace(
                '{' . 'zoneName' . '}',
                ObjectSerializer::toPathValue($zoneName),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($createDnsZoneRecordRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($createDnsZoneRecordRequest));
            } else {
                $httpBody = $createDnsZoneRecordRequest;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createPtrRecord
     *
     * Create a new PTR Record using ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreatePtrRecordRequest $createPtrRecordRequest createPtrRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPtrRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ApiPtrRecordResponse
     */
    public function createPtrRecord($xRequestId, $createPtrRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['createPtrRecord'][0])
    {
        list($response) = $this->createPtrRecordWithHttpInfo($xRequestId, $createPtrRecordRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation createPtrRecordWithHttpInfo
     *
     * Create a new PTR Record using ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreatePtrRecordRequest $createPtrRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPtrRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ApiPtrRecordResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createPtrRecordWithHttpInfo($xRequestId, $createPtrRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['createPtrRecord'][0])
    {
        $request = $this->createPtrRecordRequest($xRequestId, $createPtrRecordRequest, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 201:
                    if ('\Contabo\Generated\Model\ApiPtrRecordResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ApiPtrRecordResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ApiPtrRecordResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            $returnType = '\Contabo\Generated\Model\ApiPtrRecordResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Contabo\Generated\Model\ApiPtrRecordResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createPtrRecordAsync
     *
     * Create a new PTR Record using ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreatePtrRecordRequest $createPtrRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createPtrRecordAsync($xRequestId, $createPtrRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['createPtrRecord'][0])
    {
        return $this->createPtrRecordAsyncWithHttpInfo($xRequestId, $createPtrRecordRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createPtrRecordAsyncWithHttpInfo
     *
     * Create a new PTR Record using ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreatePtrRecordRequest $createPtrRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createPtrRecordAsyncWithHttpInfo($xRequestId, $createPtrRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['createPtrRecord'][0])
    {
        $returnType = '\Contabo\Generated\Model\ApiPtrRecordResponse';
        $request = $this->createPtrRecordRequest($xRequestId, $createPtrRecordRequest, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createPtrRecord'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreatePtrRecordRequest $createPtrRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createPtrRecordRequest($xRequestId, $createPtrRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['createPtrRecord'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling createPtrRecord'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.createPtrRecord, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'createPtrRecordRequest' is set
        if ($createPtrRecordRequest === null || (is_array($createPtrRecordRequest) && count($createPtrRecordRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $createPtrRecordRequest when calling createPtrRecord'
            );
        }



        $resourcePath = '/v1/dns/ptrs';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }



        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($createPtrRecordRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($createPtrRecordRequest));
            } else {
                $httpBody = $createPtrRecordRequest;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteDnsZone
     *
     * Delete a DNS zone.
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteDnsZone'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteDnsZone($xRequestId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['deleteDnsZone'][0])
    {
        $this->deleteDnsZoneWithHttpInfo($xRequestId, $zoneName, $xTraceId, $contentType);
    }

    /**
     * Operation deleteDnsZoneWithHttpInfo
     *
     * Delete a DNS zone.
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteDnsZone'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteDnsZoneWithHttpInfo($xRequestId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['deleteDnsZone'][0])
    {
        $request = $this->deleteDnsZoneRequest($xRequestId, $zoneName, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation deleteDnsZoneAsync
     *
     * Delete a DNS zone.
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteDnsZone'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDnsZoneAsync($xRequestId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['deleteDnsZone'][0])
    {
        return $this->deleteDnsZoneAsyncWithHttpInfo($xRequestId, $zoneName, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteDnsZoneAsyncWithHttpInfo
     *
     * Delete a DNS zone.
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteDnsZone'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDnsZoneAsyncWithHttpInfo($xRequestId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['deleteDnsZone'][0])
    {
        $returnType = '';
        $request = $this->deleteDnsZoneRequest($xRequestId, $zoneName, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteDnsZone'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteDnsZone'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteDnsZoneRequest($xRequestId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['deleteDnsZone'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling deleteDnsZone'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.deleteDnsZone, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'zoneName' is set
        if ($zoneName === null || (is_array($zoneName) && count($zoneName) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zoneName when calling deleteDnsZone'
            );
        }



        $resourcePath = '/v1/dns/zones/{zoneName}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }

        // path params
        if ($zoneName !== null) {
            $resourcePath = str_replace(
                '{' . 'zoneName' . '}',
                ObjectSerializer::toPathValue($zoneName),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteDnsZoneRecord
     *
     * Delete a DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $recordId The identifier of the DNS record (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteDnsZoneRecord($xRequestId, $recordId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['deleteDnsZoneRecord'][0])
    {
        $this->deleteDnsZoneRecordWithHttpInfo($xRequestId, $recordId, $zoneName, $xTraceId, $contentType);
    }

    /**
     * Operation deleteDnsZoneRecordWithHttpInfo
     *
     * Delete a DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $recordId The identifier of the DNS record (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteDnsZoneRecordWithHttpInfo($xRequestId, $recordId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['deleteDnsZoneRecord'][0])
    {
        $request = $this->deleteDnsZoneRecordRequest($xRequestId, $recordId, $zoneName, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation deleteDnsZoneRecordAsync
     *
     * Delete a DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $recordId The identifier of the DNS record (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDnsZoneRecordAsync($xRequestId, $recordId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['deleteDnsZoneRecord'][0])
    {
        return $this->deleteDnsZoneRecordAsyncWithHttpInfo($xRequestId, $recordId, $zoneName, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteDnsZoneRecordAsyncWithHttpInfo
     *
     * Delete a DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $recordId The identifier of the DNS record (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDnsZoneRecordAsyncWithHttpInfo($xRequestId, $recordId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['deleteDnsZoneRecord'][0])
    {
        $returnType = '';
        $request = $this->deleteDnsZoneRecordRequest($xRequestId, $recordId, $zoneName, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteDnsZoneRecord'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $recordId The identifier of the DNS record (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteDnsZoneRecordRequest($xRequestId, $recordId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['deleteDnsZoneRecord'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling deleteDnsZoneRecord'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.deleteDnsZoneRecord, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'recordId' is set
        if ($recordId === null || (is_array($recordId) && count($recordId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $recordId when calling deleteDnsZoneRecord'
            );
        }

        // verify the required parameter 'zoneName' is set
        if ($zoneName === null || (is_array($zoneName) && count($zoneName) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zoneName when calling deleteDnsZoneRecord'
            );
        }



        $resourcePath = '/v1/dns/zones/{zoneName}/records/{recordId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }

        // path params
        if ($recordId !== null) {
            $resourcePath = str_replace(
                '{' . 'recordId' . '}',
                ObjectSerializer::toPathValue($recordId),
                $resourcePath
            );
        }
        // path params
        if ($zoneName !== null) {
            $resourcePath = str_replace(
                '{' . 'zoneName' . '}',
                ObjectSerializer::toPathValue($zoneName),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deletePtrRecord
     *
     * Delete a PTR Record using ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePtrRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deletePtrRecord($xRequestId, $ipAddress, $xTraceId = null, string $contentType = self::contentTypes['deletePtrRecord'][0])
    {
        $this->deletePtrRecordWithHttpInfo($xRequestId, $ipAddress, $xTraceId, $contentType);
    }

    /**
     * Operation deletePtrRecordWithHttpInfo
     *
     * Delete a PTR Record using ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePtrRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deletePtrRecordWithHttpInfo($xRequestId, $ipAddress, $xTraceId = null, string $contentType = self::contentTypes['deletePtrRecord'][0])
    {
        $request = $this->deletePtrRecordRequest($xRequestId, $ipAddress, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation deletePtrRecordAsync
     *
     * Delete a PTR Record using ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deletePtrRecordAsync($xRequestId, $ipAddress, $xTraceId = null, string $contentType = self::contentTypes['deletePtrRecord'][0])
    {
        return $this->deletePtrRecordAsyncWithHttpInfo($xRequestId, $ipAddress, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deletePtrRecordAsyncWithHttpInfo
     *
     * Delete a PTR Record using ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deletePtrRecordAsyncWithHttpInfo($xRequestId, $ipAddress, $xTraceId = null, string $contentType = self::contentTypes['deletePtrRecord'][0])
    {
        $returnType = '';
        $request = $this->deletePtrRecordRequest($xRequestId, $ipAddress, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deletePtrRecord'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deletePtrRecordRequest($xRequestId, $ipAddress, $xTraceId = null, string $contentType = self::contentTypes['deletePtrRecord'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling deletePtrRecord'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.deletePtrRecord, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'ipAddress' is set
        if ($ipAddress === null || (is_array($ipAddress) && count($ipAddress) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ipAddress when calling deletePtrRecord'
            );
        }



        $resourcePath = '/v1/dns/ptrs/{ipAddress}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }

        // path params
        if ($ipAddress !== null) {
            $resourcePath = str_replace(
                '{' . 'ipAddress' . '}',
                ObjectSerializer::toPathValue($ipAddress),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrieveDnsZone
     *
     * Retrieve a DNS Zone by zone name
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZone'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function retrieveDnsZone($xRequestId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['retrieveDnsZone'][0])
    {
        $this->retrieveDnsZoneWithHttpInfo($xRequestId, $zoneName, $xTraceId, $contentType);
    }

    /**
     * Operation retrieveDnsZoneWithHttpInfo
     *
     * Retrieve a DNS Zone by zone name
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZone'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveDnsZoneWithHttpInfo($xRequestId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['retrieveDnsZone'][0])
    {
        $request = $this->retrieveDnsZoneRequest($xRequestId, $zoneName, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveDnsZoneAsync
     *
     * Retrieve a DNS Zone by zone name
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZone'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveDnsZoneAsync($xRequestId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['retrieveDnsZone'][0])
    {
        return $this->retrieveDnsZoneAsyncWithHttpInfo($xRequestId, $zoneName, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveDnsZoneAsyncWithHttpInfo
     *
     * Retrieve a DNS Zone by zone name
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZone'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveDnsZoneAsyncWithHttpInfo($xRequestId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['retrieveDnsZone'][0])
    {
        $returnType = '';
        $request = $this->retrieveDnsZoneRequest($xRequestId, $zoneName, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'retrieveDnsZone'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZone'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveDnsZoneRequest($xRequestId, $zoneName, $xTraceId = null, string $contentType = self::contentTypes['retrieveDnsZone'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrieveDnsZone'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.retrieveDnsZone, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'zoneName' is set
        if ($zoneName === null || (is_array($zoneName) && count($zoneName) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zoneName when calling retrieveDnsZone'
            );
        }



        $resourcePath = '/v1/dns/zones/{zoneName}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }

        // path params
        if ($zoneName !== null) {
            $resourcePath = str_replace(
                '{' . 'zoneName' . '}',
                ObjectSerializer::toPathValue($zoneName),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrieveDnsZoneRecordsList
     *
     * List a DNS Zone&#39;s records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $search Search DNS records by name, type or data (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZoneRecordsList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ListDnsZoneRecordsResponse
     */
    public function retrieveDnsZoneRecordsList($xRequestId, $zoneName, $xTraceId = null, $page = null, $size = null, $orderBy = null, $search = null, string $contentType = self::contentTypes['retrieveDnsZoneRecordsList'][0])
    {
        list($response) = $this->retrieveDnsZoneRecordsListWithHttpInfo($xRequestId, $zoneName, $xTraceId, $page, $size, $orderBy, $search, $contentType);
        return $response;
    }

    /**
     * Operation retrieveDnsZoneRecordsListWithHttpInfo
     *
     * List a DNS Zone&#39;s records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $search Search DNS records by name, type or data (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZoneRecordsList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ListDnsZoneRecordsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveDnsZoneRecordsListWithHttpInfo($xRequestId, $zoneName, $xTraceId = null, $page = null, $size = null, $orderBy = null, $search = null, string $contentType = self::contentTypes['retrieveDnsZoneRecordsList'][0])
    {
        $request = $this->retrieveDnsZoneRecordsListRequest($xRequestId, $zoneName, $xTraceId, $page, $size, $orderBy, $search, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    if ('\Contabo\Generated\Model\ListDnsZoneRecordsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ListDnsZoneRecordsResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ListDnsZoneRecordsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            $returnType = '\Contabo\Generated\Model\ListDnsZoneRecordsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Contabo\Generated\Model\ListDnsZoneRecordsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveDnsZoneRecordsListAsync
     *
     * List a DNS Zone&#39;s records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $search Search DNS records by name, type or data (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZoneRecordsList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveDnsZoneRecordsListAsync($xRequestId, $zoneName, $xTraceId = null, $page = null, $size = null, $orderBy = null, $search = null, string $contentType = self::contentTypes['retrieveDnsZoneRecordsList'][0])
    {
        return $this->retrieveDnsZoneRecordsListAsyncWithHttpInfo($xRequestId, $zoneName, $xTraceId, $page, $size, $orderBy, $search, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveDnsZoneRecordsListAsyncWithHttpInfo
     *
     * List a DNS Zone&#39;s records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $search Search DNS records by name, type or data (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZoneRecordsList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveDnsZoneRecordsListAsyncWithHttpInfo($xRequestId, $zoneName, $xTraceId = null, $page = null, $size = null, $orderBy = null, $search = null, string $contentType = self::contentTypes['retrieveDnsZoneRecordsList'][0])
    {
        $returnType = '\Contabo\Generated\Model\ListDnsZoneRecordsResponse';
        $request = $this->retrieveDnsZoneRecordsListRequest($xRequestId, $zoneName, $xTraceId, $page, $size, $orderBy, $search, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'retrieveDnsZoneRecordsList'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $zoneName Zone name (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $search Search DNS records by name, type or data (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZoneRecordsList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveDnsZoneRecordsListRequest($xRequestId, $zoneName, $xTraceId = null, $page = null, $size = null, $orderBy = null, $search = null, string $contentType = self::contentTypes['retrieveDnsZoneRecordsList'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrieveDnsZoneRecordsList'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.retrieveDnsZoneRecordsList, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'zoneName' is set
        if ($zoneName === null || (is_array($zoneName) && count($zoneName) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zoneName when calling retrieveDnsZoneRecordsList'
            );
        }







        $resourcePath = '/v1/dns/zones/{zoneName}/records';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $size,
            'size', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $orderBy,
            'orderBy', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $search,
            'search', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);

        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }

        // path params
        if ($zoneName !== null) {
            $resourcePath = str_replace(
                '{' . 'zoneName' . '}',
                ObjectSerializer::toPathValue($zoneName),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrieveDnsZonesList
     *
     * List DNS zones
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $customerId Customer ID (optional)
     * @param  string|null $tenantId Tenant ID (optional)
     * @param  string|null $zoneName Seach by zone name (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZonesList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ListDnsZonesResponse
     */
    public function retrieveDnsZonesList($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $customerId = null, $tenantId = null, $zoneName = null, string $contentType = self::contentTypes['retrieveDnsZonesList'][0])
    {
        list($response) = $this->retrieveDnsZonesListWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $zoneName, $contentType);
        return $response;
    }

    /**
     * Operation retrieveDnsZonesListWithHttpInfo
     *
     * List DNS zones
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $customerId Customer ID (optional)
     * @param  string|null $tenantId Tenant ID (optional)
     * @param  string|null $zoneName Seach by zone name (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZonesList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ListDnsZonesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveDnsZonesListWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $customerId = null, $tenantId = null, $zoneName = null, string $contentType = self::contentTypes['retrieveDnsZonesList'][0])
    {
        $request = $this->retrieveDnsZonesListRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $zoneName, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    if ('\Contabo\Generated\Model\ListDnsZonesResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ListDnsZonesResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ListDnsZonesResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            $returnType = '\Contabo\Generated\Model\ListDnsZonesResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Contabo\Generated\Model\ListDnsZonesResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveDnsZonesListAsync
     *
     * List DNS zones
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $customerId Customer ID (optional)
     * @param  string|null $tenantId Tenant ID (optional)
     * @param  string|null $zoneName Seach by zone name (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZonesList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveDnsZonesListAsync($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $customerId = null, $tenantId = null, $zoneName = null, string $contentType = self::contentTypes['retrieveDnsZonesList'][0])
    {
        return $this->retrieveDnsZonesListAsyncWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $zoneName, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveDnsZonesListAsyncWithHttpInfo
     *
     * List DNS zones
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $customerId Customer ID (optional)
     * @param  string|null $tenantId Tenant ID (optional)
     * @param  string|null $zoneName Seach by zone name (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZonesList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveDnsZonesListAsyncWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $customerId = null, $tenantId = null, $zoneName = null, string $contentType = self::contentTypes['retrieveDnsZonesList'][0])
    {
        $returnType = '\Contabo\Generated\Model\ListDnsZonesResponse';
        $request = $this->retrieveDnsZonesListRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $zoneName, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'retrieveDnsZonesList'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $customerId Customer ID (optional)
     * @param  string|null $tenantId Tenant ID (optional)
     * @param  string|null $zoneName Seach by zone name (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDnsZonesList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveDnsZonesListRequest($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $customerId = null, $tenantId = null, $zoneName = null, string $contentType = self::contentTypes['retrieveDnsZonesList'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrieveDnsZonesList'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.retrieveDnsZonesList, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        








        $resourcePath = '/v1/dns/zones';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $size,
            'size', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $orderBy,
            'orderBy', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $customerId,
            'customerId', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tenantId,
            'tenantId', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $zoneName,
            'zoneName', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);

        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }



        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrievePtrRecord
     *
     * Retrieve a PTR Record by ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePtrRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ApiPtrRecordResponse
     */
    public function retrievePtrRecord($xRequestId, $ipAddress, $xTraceId = null, string $contentType = self::contentTypes['retrievePtrRecord'][0])
    {
        list($response) = $this->retrievePtrRecordWithHttpInfo($xRequestId, $ipAddress, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation retrievePtrRecordWithHttpInfo
     *
     * Retrieve a PTR Record by ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePtrRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ApiPtrRecordResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrievePtrRecordWithHttpInfo($xRequestId, $ipAddress, $xTraceId = null, string $contentType = self::contentTypes['retrievePtrRecord'][0])
    {
        $request = $this->retrievePtrRecordRequest($xRequestId, $ipAddress, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    if ('\Contabo\Generated\Model\ApiPtrRecordResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ApiPtrRecordResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ApiPtrRecordResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            $returnType = '\Contabo\Generated\Model\ApiPtrRecordResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Contabo\Generated\Model\ApiPtrRecordResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrievePtrRecordAsync
     *
     * Retrieve a PTR Record by ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrievePtrRecordAsync($xRequestId, $ipAddress, $xTraceId = null, string $contentType = self::contentTypes['retrievePtrRecord'][0])
    {
        return $this->retrievePtrRecordAsyncWithHttpInfo($xRequestId, $ipAddress, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrievePtrRecordAsyncWithHttpInfo
     *
     * Retrieve a PTR Record by ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrievePtrRecordAsyncWithHttpInfo($xRequestId, $ipAddress, $xTraceId = null, string $contentType = self::contentTypes['retrievePtrRecord'][0])
    {
        $returnType = '\Contabo\Generated\Model\ApiPtrRecordResponse';
        $request = $this->retrievePtrRecordRequest($xRequestId, $ipAddress, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'retrievePtrRecord'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrievePtrRecordRequest($xRequestId, $ipAddress, $xTraceId = null, string $contentType = self::contentTypes['retrievePtrRecord'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrievePtrRecord'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.retrievePtrRecord, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'ipAddress' is set
        if ($ipAddress === null || (is_array($ipAddress) && count($ipAddress) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ipAddress when calling retrievePtrRecord'
            );
        }



        $resourcePath = '/v1/dns/ptrs/{ipAddress}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }

        // path params
        if ($ipAddress !== null) {
            $resourcePath = str_replace(
                '{' . 'ipAddress' . '}',
                ObjectSerializer::toPathValue($ipAddress),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrievePtrRecordsList
     *
     * List PTR records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $customerId Customer ID (optional)
     * @param  string|null $tenantId Tenant ID (optional)
     * @param  string[]|null $ips List of IPs, separated by commas (optional)
     * @param  string|null $search Search PTR records by ip or data (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePtrRecordsList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ListPtrRecordsResponse
     */
    public function retrievePtrRecordsList($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $customerId = null, $tenantId = null, $ips = null, $search = null, string $contentType = self::contentTypes['retrievePtrRecordsList'][0])
    {
        list($response) = $this->retrievePtrRecordsListWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $ips, $search, $contentType);
        return $response;
    }

    /**
     * Operation retrievePtrRecordsListWithHttpInfo
     *
     * List PTR records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $customerId Customer ID (optional)
     * @param  string|null $tenantId Tenant ID (optional)
     * @param  string[]|null $ips List of IPs, separated by commas (optional)
     * @param  string|null $search Search PTR records by ip or data (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePtrRecordsList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ListPtrRecordsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrievePtrRecordsListWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $customerId = null, $tenantId = null, $ips = null, $search = null, string $contentType = self::contentTypes['retrievePtrRecordsList'][0])
    {
        $request = $this->retrievePtrRecordsListRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $ips, $search, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    if ('\Contabo\Generated\Model\ListPtrRecordsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ListPtrRecordsResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ListPtrRecordsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            $returnType = '\Contabo\Generated\Model\ListPtrRecordsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Contabo\Generated\Model\ListPtrRecordsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrievePtrRecordsListAsync
     *
     * List PTR records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $customerId Customer ID (optional)
     * @param  string|null $tenantId Tenant ID (optional)
     * @param  string[]|null $ips List of IPs, separated by commas (optional)
     * @param  string|null $search Search PTR records by ip or data (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePtrRecordsList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrievePtrRecordsListAsync($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $customerId = null, $tenantId = null, $ips = null, $search = null, string $contentType = self::contentTypes['retrievePtrRecordsList'][0])
    {
        return $this->retrievePtrRecordsListAsyncWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $ips, $search, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrievePtrRecordsListAsyncWithHttpInfo
     *
     * List PTR records
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $customerId Customer ID (optional)
     * @param  string|null $tenantId Tenant ID (optional)
     * @param  string[]|null $ips List of IPs, separated by commas (optional)
     * @param  string|null $search Search PTR records by ip or data (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePtrRecordsList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrievePtrRecordsListAsyncWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $customerId = null, $tenantId = null, $ips = null, $search = null, string $contentType = self::contentTypes['retrievePtrRecordsList'][0])
    {
        $returnType = '\Contabo\Generated\Model\ListPtrRecordsResponse';
        $request = $this->retrievePtrRecordsListRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $ips, $search, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'retrievePtrRecordsList'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $customerId Customer ID (optional)
     * @param  string|null $tenantId Tenant ID (optional)
     * @param  string[]|null $ips List of IPs, separated by commas (optional)
     * @param  string|null $search Search PTR records by ip or data (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePtrRecordsList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrievePtrRecordsListRequest($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $customerId = null, $tenantId = null, $ips = null, $search = null, string $contentType = self::contentTypes['retrievePtrRecordsList'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrievePtrRecordsList'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.retrievePtrRecordsList, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        









        $resourcePath = '/v1/dns/ptrs';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $size,
            'size', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $orderBy,
            'orderBy', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $customerId,
            'customerId', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tenantId,
            'tenantId', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $ips,
            'ips', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $search,
            'search', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);

        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }



        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateDnsZoneRecord
     *
     * Update DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $recordId The identifier of the DNS record (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\UpdateDnsZoneRecordRequest $updateDnsZoneRecordRequest updateDnsZoneRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ApiDnsZoneRecordResponse
     */
    public function updateDnsZoneRecord($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['updateDnsZoneRecord'][0])
    {
        list($response) = $this->updateDnsZoneRecordWithHttpInfo($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation updateDnsZoneRecordWithHttpInfo
     *
     * Update DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $recordId The identifier of the DNS record (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\UpdateDnsZoneRecordRequest $updateDnsZoneRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ApiDnsZoneRecordResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateDnsZoneRecordWithHttpInfo($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['updateDnsZoneRecord'][0])
    {
        $request = $this->updateDnsZoneRecordRequest($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    if ('\Contabo\Generated\Model\ApiDnsZoneRecordResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ApiDnsZoneRecordResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ApiDnsZoneRecordResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            $returnType = '\Contabo\Generated\Model\ApiDnsZoneRecordResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Contabo\Generated\Model\ApiDnsZoneRecordResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateDnsZoneRecordAsync
     *
     * Update DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $recordId The identifier of the DNS record (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\UpdateDnsZoneRecordRequest $updateDnsZoneRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateDnsZoneRecordAsync($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['updateDnsZoneRecord'][0])
    {
        return $this->updateDnsZoneRecordAsyncWithHttpInfo($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateDnsZoneRecordAsyncWithHttpInfo
     *
     * Update DNS zone record
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $recordId The identifier of the DNS record (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\UpdateDnsZoneRecordRequest $updateDnsZoneRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateDnsZoneRecordAsyncWithHttpInfo($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['updateDnsZoneRecord'][0])
    {
        $returnType = '\Contabo\Generated\Model\ApiDnsZoneRecordResponse';
        $request = $this->updateDnsZoneRecordRequest($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateDnsZoneRecord'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $recordId The identifier of the DNS record (required)
     * @param  string $zoneName Zone name (required)
     * @param  \Contabo\Generated\Model\UpdateDnsZoneRecordRequest $updateDnsZoneRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateDnsZoneRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateDnsZoneRecordRequest($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['updateDnsZoneRecord'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling updateDnsZoneRecord'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.updateDnsZoneRecord, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'recordId' is set
        if ($recordId === null || (is_array($recordId) && count($recordId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $recordId when calling updateDnsZoneRecord'
            );
        }

        // verify the required parameter 'zoneName' is set
        if ($zoneName === null || (is_array($zoneName) && count($zoneName) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zoneName when calling updateDnsZoneRecord'
            );
        }

        // verify the required parameter 'updateDnsZoneRecordRequest' is set
        if ($updateDnsZoneRecordRequest === null || (is_array($updateDnsZoneRecordRequest) && count($updateDnsZoneRecordRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $updateDnsZoneRecordRequest when calling updateDnsZoneRecord'
            );
        }



        $resourcePath = '/v1/dns/zones/{zoneName}/records/{recordId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }

        // path params
        if ($recordId !== null) {
            $resourcePath = str_replace(
                '{' . 'recordId' . '}',
                ObjectSerializer::toPathValue($recordId),
                $resourcePath
            );
        }
        // path params
        if ($zoneName !== null) {
            $resourcePath = str_replace(
                '{' . 'zoneName' . '}',
                ObjectSerializer::toPathValue($zoneName),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($updateDnsZoneRecordRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($updateDnsZoneRecordRequest));
            } else {
                $httpBody = $updateDnsZoneRecordRequest;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PATCH',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updatePtrRecord
     *
     * Edit a PTR Record by ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  \Contabo\Generated\Model\UpdatePtrRecordRequest $updatePtrRecordRequest updatePtrRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePtrRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function updatePtrRecord($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['updatePtrRecord'][0])
    {
        $this->updatePtrRecordWithHttpInfo($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId, $contentType);
    }

    /**
     * Operation updatePtrRecordWithHttpInfo
     *
     * Edit a PTR Record by ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  \Contabo\Generated\Model\UpdatePtrRecordRequest $updatePtrRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePtrRecord'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function updatePtrRecordWithHttpInfo($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['updatePtrRecord'][0])
    {
        $request = $this->updatePtrRecordRequest($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation updatePtrRecordAsync
     *
     * Edit a PTR Record by ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  \Contabo\Generated\Model\UpdatePtrRecordRequest $updatePtrRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updatePtrRecordAsync($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['updatePtrRecord'][0])
    {
        return $this->updatePtrRecordAsyncWithHttpInfo($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updatePtrRecordAsyncWithHttpInfo
     *
     * Edit a PTR Record by ip address
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  \Contabo\Generated\Model\UpdatePtrRecordRequest $updatePtrRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updatePtrRecordAsyncWithHttpInfo($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['updatePtrRecord'][0])
    {
        $returnType = '';
        $request = $this->updatePtrRecordRequest($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'updatePtrRecord'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $ipAddress Ip Address (required)
     * @param  \Contabo\Generated\Model\UpdatePtrRecordRequest $updatePtrRecordRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePtrRecord'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updatePtrRecordRequest($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId = null, string $contentType = self::contentTypes['updatePtrRecord'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling updatePtrRecord'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling DNSApi.updatePtrRecord, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'ipAddress' is set
        if ($ipAddress === null || (is_array($ipAddress) && count($ipAddress) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ipAddress when calling updatePtrRecord'
            );
        }

        // verify the required parameter 'updatePtrRecordRequest' is set
        if ($updatePtrRecordRequest === null || (is_array($updatePtrRecordRequest) && count($updatePtrRecordRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $updatePtrRecordRequest when calling updatePtrRecord'
            );
        }



        $resourcePath = '/v1/dns/ptrs/{ipAddress}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($xRequestId !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($xRequestId);
        }
        // header params
        if ($xTraceId !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($xTraceId);
        }

        // path params
        if ($ipAddress !== null) {
            $resourcePath = str_replace(
                '{' . 'ipAddress' . '}',
                ObjectSerializer::toPathValue($ipAddress),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($updatePtrRecordRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($updatePtrRecordRequest));
            } else {
                $httpBody = $updatePtrRecordRequest;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
