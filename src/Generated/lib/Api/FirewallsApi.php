<?php
/**
 * FirewallsApi
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
 * FirewallsApi Class Doc Comment
 *
 * @category Class
 * @package  Contabo\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class FirewallsApi
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
        'assignInstanceFirewall' => [
            'application/json',
        ],
        'createFirewall' => [
            'application/json',
        ],
        'deleteFirewall' => [
            'application/json',
        ],
        'patchFirewall' => [
            'application/json',
        ],
        'putFirewall' => [
            'application/json',
        ],
        'retrieveFirewall' => [
            'application/json',
        ],
        'retrieveFirewallList' => [
            'application/json',
        ],
        'retrievePresetRules' => [
            'application/json',
        ],
        'unassignInstanceFirewall' => [
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
     * Operation assignInstanceFirewall
     *
     * Add instance to a firewall
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  int $instanceId The identifier of the instance (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['assignInstanceFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\AssignInstanceFirewallResponse
     */
    public function assignInstanceFirewall($xRequestId, $firewallId, $instanceId, $xTraceId = null, string $contentType = self::contentTypes['assignInstanceFirewall'][0])
    {
        list($response) = $this->assignInstanceFirewallWithHttpInfo($xRequestId, $firewallId, $instanceId, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation assignInstanceFirewallWithHttpInfo
     *
     * Add instance to a firewall
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  int $instanceId The identifier of the instance (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['assignInstanceFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\AssignInstanceFirewallResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function assignInstanceFirewallWithHttpInfo($xRequestId, $firewallId, $instanceId, $xTraceId = null, string $contentType = self::contentTypes['assignInstanceFirewall'][0])
    {
        $request = $this->assignInstanceFirewallRequest($xRequestId, $firewallId, $instanceId, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\AssignInstanceFirewallResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\AssignInstanceFirewallResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\AssignInstanceFirewallResponse', []),
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

            $returnType = '\Contabo\Generated\Model\AssignInstanceFirewallResponse';
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
                        '\Contabo\Generated\Model\AssignInstanceFirewallResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation assignInstanceFirewallAsync
     *
     * Add instance to a firewall
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  int $instanceId The identifier of the instance (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['assignInstanceFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function assignInstanceFirewallAsync($xRequestId, $firewallId, $instanceId, $xTraceId = null, string $contentType = self::contentTypes['assignInstanceFirewall'][0])
    {
        return $this->assignInstanceFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $instanceId, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation assignInstanceFirewallAsyncWithHttpInfo
     *
     * Add instance to a firewall
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  int $instanceId The identifier of the instance (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['assignInstanceFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function assignInstanceFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $instanceId, $xTraceId = null, string $contentType = self::contentTypes['assignInstanceFirewall'][0])
    {
        $returnType = '\Contabo\Generated\Model\AssignInstanceFirewallResponse';
        $request = $this->assignInstanceFirewallRequest($xRequestId, $firewallId, $instanceId, $xTraceId, $contentType);

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
     * Create request for operation 'assignInstanceFirewall'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  int $instanceId The identifier of the instance (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['assignInstanceFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function assignInstanceFirewallRequest($xRequestId, $firewallId, $instanceId, $xTraceId = null, string $contentType = self::contentTypes['assignInstanceFirewall'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling assignInstanceFirewall'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling FirewallsApi.assignInstanceFirewall, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'firewallId' is set
        if ($firewallId === null || (is_array($firewallId) && count($firewallId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $firewallId when calling assignInstanceFirewall'
            );
        }

        // verify the required parameter 'instanceId' is set
        if ($instanceId === null || (is_array($instanceId) && count($instanceId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instanceId when calling assignInstanceFirewall'
            );
        }



        $resourcePath = '/v1/firewalls/{firewallId}/instances/{instanceId}';
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
        if ($firewallId !== null) {
            $resourcePath = str_replace(
                '{' . 'firewallId' . '}',
                ObjectSerializer::toPathValue($firewallId),
                $resourcePath
            );
        }
        // path params
        if ($instanceId !== null) {
            $resourcePath = str_replace(
                '{' . 'instanceId' . '}',
                ObjectSerializer::toPathValue($instanceId),
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createFirewall
     *
     * Create a new firewall definition
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateFirewallRequest $createFirewallRequest createFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\CreateFirewallResponse
     */
    public function createFirewall($xRequestId, $createFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['createFirewall'][0])
    {
        list($response) = $this->createFirewallWithHttpInfo($xRequestId, $createFirewallRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation createFirewallWithHttpInfo
     *
     * Create a new firewall definition
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateFirewallRequest $createFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\CreateFirewallResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createFirewallWithHttpInfo($xRequestId, $createFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['createFirewall'][0])
    {
        $request = $this->createFirewallRequest($xRequestId, $createFirewallRequest, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\CreateFirewallResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\CreateFirewallResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\CreateFirewallResponse', []),
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

            $returnType = '\Contabo\Generated\Model\CreateFirewallResponse';
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
                        '\Contabo\Generated\Model\CreateFirewallResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createFirewallAsync
     *
     * Create a new firewall definition
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateFirewallRequest $createFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createFirewallAsync($xRequestId, $createFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['createFirewall'][0])
    {
        return $this->createFirewallAsyncWithHttpInfo($xRequestId, $createFirewallRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createFirewallAsyncWithHttpInfo
     *
     * Create a new firewall definition
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateFirewallRequest $createFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createFirewallAsyncWithHttpInfo($xRequestId, $createFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['createFirewall'][0])
    {
        $returnType = '\Contabo\Generated\Model\CreateFirewallResponse';
        $request = $this->createFirewallRequest($xRequestId, $createFirewallRequest, $xTraceId, $contentType);

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
     * Create request for operation 'createFirewall'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateFirewallRequest $createFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createFirewallRequest($xRequestId, $createFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['createFirewall'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling createFirewall'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling FirewallsApi.createFirewall, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'createFirewallRequest' is set
        if ($createFirewallRequest === null || (is_array($createFirewallRequest) && count($createFirewallRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $createFirewallRequest when calling createFirewall'
            );
        }



        $resourcePath = '/v1/firewalls';
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
        if (isset($createFirewallRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($createFirewallRequest));
            } else {
                $httpBody = $createFirewallRequest;
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
     * Operation deleteFirewall
     *
     * Delete existing firewall by id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteFirewall($xRequestId, $firewallId, $xTraceId = null, string $contentType = self::contentTypes['deleteFirewall'][0])
    {
        $this->deleteFirewallWithHttpInfo($xRequestId, $firewallId, $xTraceId, $contentType);
    }

    /**
     * Operation deleteFirewallWithHttpInfo
     *
     * Delete existing firewall by id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteFirewallWithHttpInfo($xRequestId, $firewallId, $xTraceId = null, string $contentType = self::contentTypes['deleteFirewall'][0])
    {
        $request = $this->deleteFirewallRequest($xRequestId, $firewallId, $xTraceId, $contentType);

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
     * Operation deleteFirewallAsync
     *
     * Delete existing firewall by id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteFirewallAsync($xRequestId, $firewallId, $xTraceId = null, string $contentType = self::contentTypes['deleteFirewall'][0])
    {
        return $this->deleteFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteFirewallAsyncWithHttpInfo
     *
     * Delete existing firewall by id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $xTraceId = null, string $contentType = self::contentTypes['deleteFirewall'][0])
    {
        $returnType = '';
        $request = $this->deleteFirewallRequest($xRequestId, $firewallId, $xTraceId, $contentType);

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
     * Create request for operation 'deleteFirewall'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteFirewallRequest($xRequestId, $firewallId, $xTraceId = null, string $contentType = self::contentTypes['deleteFirewall'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling deleteFirewall'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling FirewallsApi.deleteFirewall, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'firewallId' is set
        if ($firewallId === null || (is_array($firewallId) && count($firewallId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $firewallId when calling deleteFirewall'
            );
        }



        $resourcePath = '/v1/firewalls/{firewallId}';
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
        if ($firewallId !== null) {
            $resourcePath = str_replace(
                '{' . 'firewallId' . '}',
                ObjectSerializer::toPathValue($firewallId),
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
     * Operation patchFirewall
     *
     * Update a firewall by id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  \Contabo\Generated\Model\PatchFirewallRequest $patchFirewallRequest patchFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\PatchFirewallResponse
     */
    public function patchFirewall($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['patchFirewall'][0])
    {
        list($response) = $this->patchFirewallWithHttpInfo($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation patchFirewallWithHttpInfo
     *
     * Update a firewall by id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  \Contabo\Generated\Model\PatchFirewallRequest $patchFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\PatchFirewallResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function patchFirewallWithHttpInfo($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['patchFirewall'][0])
    {
        $request = $this->patchFirewallRequest($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\PatchFirewallResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\PatchFirewallResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\PatchFirewallResponse', []),
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

            $returnType = '\Contabo\Generated\Model\PatchFirewallResponse';
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
                        '\Contabo\Generated\Model\PatchFirewallResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation patchFirewallAsync
     *
     * Update a firewall by id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  \Contabo\Generated\Model\PatchFirewallRequest $patchFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchFirewallAsync($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['patchFirewall'][0])
    {
        return $this->patchFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation patchFirewallAsyncWithHttpInfo
     *
     * Update a firewall by id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  \Contabo\Generated\Model\PatchFirewallRequest $patchFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['patchFirewall'][0])
    {
        $returnType = '\Contabo\Generated\Model\PatchFirewallResponse';
        $request = $this->patchFirewallRequest($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId, $contentType);

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
     * Create request for operation 'patchFirewall'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  \Contabo\Generated\Model\PatchFirewallRequest $patchFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function patchFirewallRequest($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['patchFirewall'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling patchFirewall'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling FirewallsApi.patchFirewall, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'firewallId' is set
        if ($firewallId === null || (is_array($firewallId) && count($firewallId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $firewallId when calling patchFirewall'
            );
        }

        // verify the required parameter 'patchFirewallRequest' is set
        if ($patchFirewallRequest === null || (is_array($patchFirewallRequest) && count($patchFirewallRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $patchFirewallRequest when calling patchFirewall'
            );
        }



        $resourcePath = '/v1/firewalls/{firewallId}';
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
        if ($firewallId !== null) {
            $resourcePath = str_replace(
                '{' . 'firewallId' . '}',
                ObjectSerializer::toPathValue($firewallId),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($patchFirewallRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($patchFirewallRequest));
            } else {
                $httpBody = $patchFirewallRequest;
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
     * Operation putFirewall
     *
     * Update specific firewall rules
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  \Contabo\Generated\Model\PutFirewallRequest $putFirewallRequest putFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\PutFirewallResponse
     */
    public function putFirewall($xRequestId, $firewallId, $putFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['putFirewall'][0])
    {
        list($response) = $this->putFirewallWithHttpInfo($xRequestId, $firewallId, $putFirewallRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation putFirewallWithHttpInfo
     *
     * Update specific firewall rules
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  \Contabo\Generated\Model\PutFirewallRequest $putFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\PutFirewallResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function putFirewallWithHttpInfo($xRequestId, $firewallId, $putFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['putFirewall'][0])
    {
        $request = $this->putFirewallRequest($xRequestId, $firewallId, $putFirewallRequest, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\PutFirewallResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\PutFirewallResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\PutFirewallResponse', []),
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

            $returnType = '\Contabo\Generated\Model\PutFirewallResponse';
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
                        '\Contabo\Generated\Model\PutFirewallResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation putFirewallAsync
     *
     * Update specific firewall rules
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  \Contabo\Generated\Model\PutFirewallRequest $putFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putFirewallAsync($xRequestId, $firewallId, $putFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['putFirewall'][0])
    {
        return $this->putFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $putFirewallRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation putFirewallAsyncWithHttpInfo
     *
     * Update specific firewall rules
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  \Contabo\Generated\Model\PutFirewallRequest $putFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $putFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['putFirewall'][0])
    {
        $returnType = '\Contabo\Generated\Model\PutFirewallResponse';
        $request = $this->putFirewallRequest($xRequestId, $firewallId, $putFirewallRequest, $xTraceId, $contentType);

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
     * Create request for operation 'putFirewall'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  \Contabo\Generated\Model\PutFirewallRequest $putFirewallRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function putFirewallRequest($xRequestId, $firewallId, $putFirewallRequest, $xTraceId = null, string $contentType = self::contentTypes['putFirewall'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling putFirewall'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling FirewallsApi.putFirewall, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'firewallId' is set
        if ($firewallId === null || (is_array($firewallId) && count($firewallId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $firewallId when calling putFirewall'
            );
        }

        // verify the required parameter 'putFirewallRequest' is set
        if ($putFirewallRequest === null || (is_array($putFirewallRequest) && count($putFirewallRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $putFirewallRequest when calling putFirewall'
            );
        }



        $resourcePath = '/v1/firewalls/{firewallId}';
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
        if ($firewallId !== null) {
            $resourcePath = str_replace(
                '{' . 'firewallId' . '}',
                ObjectSerializer::toPathValue($firewallId),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($putFirewallRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($putFirewallRequest));
            } else {
                $httpBody = $putFirewallRequest;
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
     * Operation retrieveFirewall
     *
     * Get specific firewall by its id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of the firewall (optional)
     * @param  string|null $instanceIds Comma separated instance IDs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\FindFirewallResponse
     */
    public function retrieveFirewall($xRequestId, $firewallId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, $instanceIds = null, string $contentType = self::contentTypes['retrieveFirewall'][0])
    {
        list($response) = $this->retrieveFirewallWithHttpInfo($xRequestId, $firewallId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds, $contentType);
        return $response;
    }

    /**
     * Operation retrieveFirewallWithHttpInfo
     *
     * Get specific firewall by its id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of the firewall (optional)
     * @param  string|null $instanceIds Comma separated instance IDs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\FindFirewallResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveFirewallWithHttpInfo($xRequestId, $firewallId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, $instanceIds = null, string $contentType = self::contentTypes['retrieveFirewall'][0])
    {
        $request = $this->retrieveFirewallRequest($xRequestId, $firewallId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds, $contentType);

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
                    if ('\Contabo\Generated\Model\FindFirewallResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\FindFirewallResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\FindFirewallResponse', []),
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

            $returnType = '\Contabo\Generated\Model\FindFirewallResponse';
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
                        '\Contabo\Generated\Model\FindFirewallResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveFirewallAsync
     *
     * Get specific firewall by its id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of the firewall (optional)
     * @param  string|null $instanceIds Comma separated instance IDs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveFirewallAsync($xRequestId, $firewallId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, $instanceIds = null, string $contentType = self::contentTypes['retrieveFirewall'][0])
    {
        return $this->retrieveFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveFirewallAsyncWithHttpInfo
     *
     * Get specific firewall by its id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of the firewall (optional)
     * @param  string|null $instanceIds Comma separated instance IDs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, $instanceIds = null, string $contentType = self::contentTypes['retrieveFirewall'][0])
    {
        $returnType = '\Contabo\Generated\Model\FindFirewallResponse';
        $request = $this->retrieveFirewallRequest($xRequestId, $firewallId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds, $contentType);

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
     * Create request for operation 'retrieveFirewall'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of the firewall (optional)
     * @param  string|null $instanceIds Comma separated instance IDs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveFirewallRequest($xRequestId, $firewallId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, $instanceIds = null, string $contentType = self::contentTypes['retrieveFirewall'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrieveFirewall'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling FirewallsApi.retrieveFirewall, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'firewallId' is set
        if ($firewallId === null || (is_array($firewallId) && count($firewallId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $firewallId when calling retrieveFirewall'
            );
        }








        $resourcePath = '/v1/firewalls/{firewallId}';
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
            $name,
            'name', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $instanceIds,
            'instanceIds', // param base name
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
        if ($firewallId !== null) {
            $resourcePath = str_replace(
                '{' . 'firewallId' . '}',
                ObjectSerializer::toPathValue($firewallId),
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
     * Operation retrieveFirewallList
     *
     * List all firewalls
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of the firewall (optional)
     * @param  string|null $instanceIds Comma separated instance IDs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveFirewallList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ListFirewallResponse
     */
    public function retrieveFirewallList($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, $instanceIds = null, string $contentType = self::contentTypes['retrieveFirewallList'][0])
    {
        list($response) = $this->retrieveFirewallListWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds, $contentType);
        return $response;
    }

    /**
     * Operation retrieveFirewallListWithHttpInfo
     *
     * List all firewalls
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of the firewall (optional)
     * @param  string|null $instanceIds Comma separated instance IDs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveFirewallList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ListFirewallResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveFirewallListWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, $instanceIds = null, string $contentType = self::contentTypes['retrieveFirewallList'][0])
    {
        $request = $this->retrieveFirewallListRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds, $contentType);

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
                    if ('\Contabo\Generated\Model\ListFirewallResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ListFirewallResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ListFirewallResponse', []),
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

            $returnType = '\Contabo\Generated\Model\ListFirewallResponse';
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
                        '\Contabo\Generated\Model\ListFirewallResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveFirewallListAsync
     *
     * List all firewalls
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of the firewall (optional)
     * @param  string|null $instanceIds Comma separated instance IDs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveFirewallList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveFirewallListAsync($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, $instanceIds = null, string $contentType = self::contentTypes['retrieveFirewallList'][0])
    {
        return $this->retrieveFirewallListAsyncWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveFirewallListAsyncWithHttpInfo
     *
     * List all firewalls
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of the firewall (optional)
     * @param  string|null $instanceIds Comma separated instance IDs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveFirewallList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveFirewallListAsyncWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, $instanceIds = null, string $contentType = self::contentTypes['retrieveFirewallList'][0])
    {
        $returnType = '\Contabo\Generated\Model\ListFirewallResponse';
        $request = $this->retrieveFirewallListRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds, $contentType);

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
     * Create request for operation 'retrieveFirewallList'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of the firewall (optional)
     * @param  string|null $instanceIds Comma separated instance IDs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveFirewallList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveFirewallListRequest($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, $instanceIds = null, string $contentType = self::contentTypes['retrieveFirewallList'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrieveFirewallList'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling FirewallsApi.retrieveFirewallList, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        







        $resourcePath = '/v1/firewalls';
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
            $name,
            'name', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $instanceIds,
            'instanceIds', // param base name
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
     * Operation retrievePresetRules
     *
     * Get all preset rules
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of preset rule (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePresetRules'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ListPresetRulesResponse
     */
    public function retrievePresetRules($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, string $contentType = self::contentTypes['retrievePresetRules'][0])
    {
        list($response) = $this->retrievePresetRulesWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $contentType);
        return $response;
    }

    /**
     * Operation retrievePresetRulesWithHttpInfo
     *
     * Get all preset rules
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of preset rule (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePresetRules'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ListPresetRulesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrievePresetRulesWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, string $contentType = self::contentTypes['retrievePresetRules'][0])
    {
        $request = $this->retrievePresetRulesRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $contentType);

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
                    if ('\Contabo\Generated\Model\ListPresetRulesResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ListPresetRulesResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ListPresetRulesResponse', []),
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

            $returnType = '\Contabo\Generated\Model\ListPresetRulesResponse';
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
                        '\Contabo\Generated\Model\ListPresetRulesResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrievePresetRulesAsync
     *
     * Get all preset rules
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of preset rule (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePresetRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrievePresetRulesAsync($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, string $contentType = self::contentTypes['retrievePresetRules'][0])
    {
        return $this->retrievePresetRulesAsyncWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrievePresetRulesAsyncWithHttpInfo
     *
     * Get all preset rules
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of preset rule (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePresetRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrievePresetRulesAsyncWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, string $contentType = self::contentTypes['retrievePresetRules'][0])
    {
        $returnType = '\Contabo\Generated\Model\ListPresetRulesResponse';
        $request = $this->retrievePresetRulesRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $contentType);

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
     * Create request for operation 'retrievePresetRules'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $name The name of preset rule (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePresetRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrievePresetRulesRequest($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $name = null, string $contentType = self::contentTypes['retrievePresetRules'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrievePresetRules'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling FirewallsApi.retrievePresetRules, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        






        $resourcePath = '/v1/firewalls/preset-rules';
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
            $name,
            'name', // param base name
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
     * Operation unassignInstanceFirewall
     *
     * Remove instance from a firewall
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  int $instanceId The identifier of the instance (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unassignInstanceFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\UnassignInstanceFirewallResponse
     */
    public function unassignInstanceFirewall($xRequestId, $firewallId, $instanceId, $xTraceId = null, string $contentType = self::contentTypes['unassignInstanceFirewall'][0])
    {
        list($response) = $this->unassignInstanceFirewallWithHttpInfo($xRequestId, $firewallId, $instanceId, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation unassignInstanceFirewallWithHttpInfo
     *
     * Remove instance from a firewall
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  int $instanceId The identifier of the instance (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unassignInstanceFirewall'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\UnassignInstanceFirewallResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function unassignInstanceFirewallWithHttpInfo($xRequestId, $firewallId, $instanceId, $xTraceId = null, string $contentType = self::contentTypes['unassignInstanceFirewall'][0])
    {
        $request = $this->unassignInstanceFirewallRequest($xRequestId, $firewallId, $instanceId, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\UnassignInstanceFirewallResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\UnassignInstanceFirewallResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\UnassignInstanceFirewallResponse', []),
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

            $returnType = '\Contabo\Generated\Model\UnassignInstanceFirewallResponse';
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
                        '\Contabo\Generated\Model\UnassignInstanceFirewallResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation unassignInstanceFirewallAsync
     *
     * Remove instance from a firewall
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  int $instanceId The identifier of the instance (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unassignInstanceFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function unassignInstanceFirewallAsync($xRequestId, $firewallId, $instanceId, $xTraceId = null, string $contentType = self::contentTypes['unassignInstanceFirewall'][0])
    {
        return $this->unassignInstanceFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $instanceId, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation unassignInstanceFirewallAsyncWithHttpInfo
     *
     * Remove instance from a firewall
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  int $instanceId The identifier of the instance (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unassignInstanceFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function unassignInstanceFirewallAsyncWithHttpInfo($xRequestId, $firewallId, $instanceId, $xTraceId = null, string $contentType = self::contentTypes['unassignInstanceFirewall'][0])
    {
        $returnType = '\Contabo\Generated\Model\UnassignInstanceFirewallResponse';
        $request = $this->unassignInstanceFirewallRequest($xRequestId, $firewallId, $instanceId, $xTraceId, $contentType);

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
     * Create request for operation 'unassignInstanceFirewall'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $firewallId The identifier of the firewall (required)
     * @param  int $instanceId The identifier of the instance (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unassignInstanceFirewall'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function unassignInstanceFirewallRequest($xRequestId, $firewallId, $instanceId, $xTraceId = null, string $contentType = self::contentTypes['unassignInstanceFirewall'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling unassignInstanceFirewall'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling FirewallsApi.unassignInstanceFirewall, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'firewallId' is set
        if ($firewallId === null || (is_array($firewallId) && count($firewallId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $firewallId when calling unassignInstanceFirewall'
            );
        }

        // verify the required parameter 'instanceId' is set
        if ($instanceId === null || (is_array($instanceId) && count($instanceId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instanceId when calling unassignInstanceFirewall'
            );
        }



        $resourcePath = '/v1/firewalls/{firewallId}/instances/{instanceId}';
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
        if ($firewallId !== null) {
            $resourcePath = str_replace(
                '{' . 'firewallId' . '}',
                ObjectSerializer::toPathValue($firewallId),
                $resourcePath
            );
        }
        // path params
        if ($instanceId !== null) {
            $resourcePath = str_replace(
                '{' . 'instanceId' . '}',
                ObjectSerializer::toPathValue($instanceId),
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
            'DELETE',
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
