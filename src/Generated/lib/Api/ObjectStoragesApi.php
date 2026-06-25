<?php
/**
 * ObjectStoragesApi
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
 * ObjectStoragesApi Class Doc Comment
 *
 * @category Class
 * @package  Contabo\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ObjectStoragesApi
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
        'cancelObjectStorage' => [
            'application/json',
        ],
        'createObjectStorage' => [
            'application/json',
        ],
        'retrieveDataCenterList' => [
            'application/json',
        ],
        'retrieveObjectStorage' => [
            'application/json',
        ],
        'retrieveObjectStorageList' => [
            'application/json',
        ],
        'retrieveObjectStoragesStats' => [
            'application/json',
        ],
        'updateObjectStorage' => [
            'application/json',
        ],
        'upgradeObjectStorage' => [
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
     * Operation cancelObjectStorage
     *
     * Cancels the specified object storage at the next possible date
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\CancelObjectStorageRequest $cancelObjectStorageRequest cancelObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['cancelObjectStorage'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\CancelObjectStorageResponse
     */
    public function cancelObjectStorage($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['cancelObjectStorage'][0])
    {
        list($response) = $this->cancelObjectStorageWithHttpInfo($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation cancelObjectStorageWithHttpInfo
     *
     * Cancels the specified object storage at the next possible date
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\CancelObjectStorageRequest $cancelObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['cancelObjectStorage'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\CancelObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function cancelObjectStorageWithHttpInfo($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['cancelObjectStorage'][0])
    {
        $request = $this->cancelObjectStorageRequest($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\CancelObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\CancelObjectStorageResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\CancelObjectStorageResponse', []),
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

            $returnType = '\Contabo\Generated\Model\CancelObjectStorageResponse';
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
                        '\Contabo\Generated\Model\CancelObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation cancelObjectStorageAsync
     *
     * Cancels the specified object storage at the next possible date
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\CancelObjectStorageRequest $cancelObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['cancelObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelObjectStorageAsync($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['cancelObjectStorage'][0])
    {
        return $this->cancelObjectStorageAsyncWithHttpInfo($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cancelObjectStorageAsyncWithHttpInfo
     *
     * Cancels the specified object storage at the next possible date
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\CancelObjectStorageRequest $cancelObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['cancelObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelObjectStorageAsyncWithHttpInfo($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['cancelObjectStorage'][0])
    {
        $returnType = '\Contabo\Generated\Model\CancelObjectStorageResponse';
        $request = $this->cancelObjectStorageRequest($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId, $contentType);

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
     * Create request for operation 'cancelObjectStorage'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\CancelObjectStorageRequest $cancelObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['cancelObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function cancelObjectStorageRequest($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['cancelObjectStorage'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling cancelObjectStorage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling ObjectStoragesApi.cancelObjectStorage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'objectStorageId' is set
        if ($objectStorageId === null || (is_array($objectStorageId) && count($objectStorageId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $objectStorageId when calling cancelObjectStorage'
            );
        }

        // verify the required parameter 'cancelObjectStorageRequest' is set
        if ($cancelObjectStorageRequest === null || (is_array($cancelObjectStorageRequest) && count($cancelObjectStorageRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cancelObjectStorageRequest when calling cancelObjectStorage'
            );
        }



        $resourcePath = '/v1/object-storages/{objectStorageId}/cancel';
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
        if ($objectStorageId !== null) {
            $resourcePath = str_replace(
                '{' . 'objectStorageId' . '}',
                ObjectSerializer::toPathValue($objectStorageId),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($cancelObjectStorageRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($cancelObjectStorageRequest));
            } else {
                $httpBody = $cancelObjectStorageRequest;
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
     * Operation createObjectStorage
     *
     * Create a new object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateObjectStorageRequest $createObjectStorageRequest createObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createObjectStorage'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\CreateObjectStorageResponse
     */
    public function createObjectStorage($xRequestId, $createObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['createObjectStorage'][0])
    {
        list($response) = $this->createObjectStorageWithHttpInfo($xRequestId, $createObjectStorageRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation createObjectStorageWithHttpInfo
     *
     * Create a new object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateObjectStorageRequest $createObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createObjectStorage'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\CreateObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createObjectStorageWithHttpInfo($xRequestId, $createObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['createObjectStorage'][0])
    {
        $request = $this->createObjectStorageRequest($xRequestId, $createObjectStorageRequest, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\CreateObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\CreateObjectStorageResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\CreateObjectStorageResponse', []),
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

            $returnType = '\Contabo\Generated\Model\CreateObjectStorageResponse';
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
                        '\Contabo\Generated\Model\CreateObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createObjectStorageAsync
     *
     * Create a new object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateObjectStorageRequest $createObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageAsync($xRequestId, $createObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['createObjectStorage'][0])
    {
        return $this->createObjectStorageAsyncWithHttpInfo($xRequestId, $createObjectStorageRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createObjectStorageAsyncWithHttpInfo
     *
     * Create a new object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateObjectStorageRequest $createObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageAsyncWithHttpInfo($xRequestId, $createObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['createObjectStorage'][0])
    {
        $returnType = '\Contabo\Generated\Model\CreateObjectStorageResponse';
        $request = $this->createObjectStorageRequest($xRequestId, $createObjectStorageRequest, $xTraceId, $contentType);

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
     * Create request for operation 'createObjectStorage'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \Contabo\Generated\Model\CreateObjectStorageRequest $createObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createObjectStorageRequest($xRequestId, $createObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['createObjectStorage'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling createObjectStorage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling ObjectStoragesApi.createObjectStorage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'createObjectStorageRequest' is set
        if ($createObjectStorageRequest === null || (is_array($createObjectStorageRequest) && count($createObjectStorageRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $createObjectStorageRequest when calling createObjectStorage'
            );
        }



        $resourcePath = '/v1/object-storages';
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
        if (isset($createObjectStorageRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($createObjectStorageRequest));
            } else {
                $httpBody = $createObjectStorageRequest;
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
     * Operation retrieveDataCenterList
     *
     * List data centers
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $slug Filter as match for data centers. (optional)
     * @param  string|null $name Filter for Object Storages regions. (optional)
     * @param  string|null $regionName Filter for Object Storage region names. (optional)
     * @param  string|null $regionSlug Filter for Object Storage region slugs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDataCenterList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ListDataCenterResponse
     */
    public function retrieveDataCenterList($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $slug = null, $name = null, $regionName = null, $regionSlug = null, string $contentType = self::contentTypes['retrieveDataCenterList'][0])
    {
        list($response) = $this->retrieveDataCenterListWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $slug, $name, $regionName, $regionSlug, $contentType);
        return $response;
    }

    /**
     * Operation retrieveDataCenterListWithHttpInfo
     *
     * List data centers
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $slug Filter as match for data centers. (optional)
     * @param  string|null $name Filter for Object Storages regions. (optional)
     * @param  string|null $regionName Filter for Object Storage region names. (optional)
     * @param  string|null $regionSlug Filter for Object Storage region slugs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDataCenterList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ListDataCenterResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveDataCenterListWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $slug = null, $name = null, $regionName = null, $regionSlug = null, string $contentType = self::contentTypes['retrieveDataCenterList'][0])
    {
        $request = $this->retrieveDataCenterListRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $slug, $name, $regionName, $regionSlug, $contentType);

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
                    if ('\Contabo\Generated\Model\ListDataCenterResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ListDataCenterResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ListDataCenterResponse', []),
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

            $returnType = '\Contabo\Generated\Model\ListDataCenterResponse';
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
                        '\Contabo\Generated\Model\ListDataCenterResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveDataCenterListAsync
     *
     * List data centers
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $slug Filter as match for data centers. (optional)
     * @param  string|null $name Filter for Object Storages regions. (optional)
     * @param  string|null $regionName Filter for Object Storage region names. (optional)
     * @param  string|null $regionSlug Filter for Object Storage region slugs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDataCenterList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveDataCenterListAsync($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $slug = null, $name = null, $regionName = null, $regionSlug = null, string $contentType = self::contentTypes['retrieveDataCenterList'][0])
    {
        return $this->retrieveDataCenterListAsyncWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $slug, $name, $regionName, $regionSlug, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveDataCenterListAsyncWithHttpInfo
     *
     * List data centers
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $slug Filter as match for data centers. (optional)
     * @param  string|null $name Filter for Object Storages regions. (optional)
     * @param  string|null $regionName Filter for Object Storage region names. (optional)
     * @param  string|null $regionSlug Filter for Object Storage region slugs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDataCenterList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveDataCenterListAsyncWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $slug = null, $name = null, $regionName = null, $regionSlug = null, string $contentType = self::contentTypes['retrieveDataCenterList'][0])
    {
        $returnType = '\Contabo\Generated\Model\ListDataCenterResponse';
        $request = $this->retrieveDataCenterListRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $slug, $name, $regionName, $regionSlug, $contentType);

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
     * Create request for operation 'retrieveDataCenterList'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $slug Filter as match for data centers. (optional)
     * @param  string|null $name Filter for Object Storages regions. (optional)
     * @param  string|null $regionName Filter for Object Storage region names. (optional)
     * @param  string|null $regionSlug Filter for Object Storage region slugs. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveDataCenterList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveDataCenterListRequest($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $slug = null, $name = null, $regionName = null, $regionSlug = null, string $contentType = self::contentTypes['retrieveDataCenterList'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrieveDataCenterList'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling ObjectStoragesApi.retrieveDataCenterList, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        




        if ($slug !== null && strlen($slug) < 1) {
            throw new \InvalidArgumentException('invalid length for "$slug" when calling ObjectStoragesApi.retrieveDataCenterList, must be bigger than or equal to 1.');
        }
        
        if ($name !== null && strlen($name) < 1) {
            throw new \InvalidArgumentException('invalid length for "$name" when calling ObjectStoragesApi.retrieveDataCenterList, must be bigger than or equal to 1.');
        }
        
        if ($regionName !== null && strlen($regionName) < 1) {
            throw new \InvalidArgumentException('invalid length for "$regionName" when calling ObjectStoragesApi.retrieveDataCenterList, must be bigger than or equal to 1.');
        }
        
        if ($regionSlug !== null && strlen($regionSlug) < 1) {
            throw new \InvalidArgumentException('invalid length for "$regionSlug" when calling ObjectStoragesApi.retrieveDataCenterList, must be bigger than or equal to 1.');
        }
        

        $resourcePath = '/v1/data-centers';
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
            $slug,
            'slug', // param base name
            'string', // openApiType
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
            $regionName,
            'regionName', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $regionSlug,
            'regionSlug', // param base name
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
     * Operation retrieveObjectStorage
     *
     * Get specific object storage by its id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStorage'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\FindObjectStorageResponse
     */
    public function retrieveObjectStorage($xRequestId, $objectStorageId, $xTraceId = null, string $contentType = self::contentTypes['retrieveObjectStorage'][0])
    {
        list($response) = $this->retrieveObjectStorageWithHttpInfo($xRequestId, $objectStorageId, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation retrieveObjectStorageWithHttpInfo
     *
     * Get specific object storage by its id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStorage'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\FindObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveObjectStorageWithHttpInfo($xRequestId, $objectStorageId, $xTraceId = null, string $contentType = self::contentTypes['retrieveObjectStorage'][0])
    {
        $request = $this->retrieveObjectStorageRequest($xRequestId, $objectStorageId, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\FindObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\FindObjectStorageResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\FindObjectStorageResponse', []),
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

            $returnType = '\Contabo\Generated\Model\FindObjectStorageResponse';
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
                        '\Contabo\Generated\Model\FindObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveObjectStorageAsync
     *
     * Get specific object storage by its id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStorageAsync($xRequestId, $objectStorageId, $xTraceId = null, string $contentType = self::contentTypes['retrieveObjectStorage'][0])
    {
        return $this->retrieveObjectStorageAsyncWithHttpInfo($xRequestId, $objectStorageId, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveObjectStorageAsyncWithHttpInfo
     *
     * Get specific object storage by its id
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStorageAsyncWithHttpInfo($xRequestId, $objectStorageId, $xTraceId = null, string $contentType = self::contentTypes['retrieveObjectStorage'][0])
    {
        $returnType = '\Contabo\Generated\Model\FindObjectStorageResponse';
        $request = $this->retrieveObjectStorageRequest($xRequestId, $objectStorageId, $xTraceId, $contentType);

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
     * Create request for operation 'retrieveObjectStorage'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveObjectStorageRequest($xRequestId, $objectStorageId, $xTraceId = null, string $contentType = self::contentTypes['retrieveObjectStorage'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrieveObjectStorage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling ObjectStoragesApi.retrieveObjectStorage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'objectStorageId' is set
        if ($objectStorageId === null || (is_array($objectStorageId) && count($objectStorageId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $objectStorageId when calling retrieveObjectStorage'
            );
        }



        $resourcePath = '/v1/object-storages/{objectStorageId}';
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
        if ($objectStorageId !== null) {
            $resourcePath = str_replace(
                '{' . 'objectStorageId' . '}',
                ObjectSerializer::toPathValue($objectStorageId),
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
     * Operation retrieveObjectStorageList
     *
     * List all your object storages
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $dataCenterName Filter for Object Storage locations. (optional)
     * @param  string|null $s3TenantId Filter for Object Storage S3 tenantId. (optional)
     * @param  string|null $region Filter for Object Storage by regions. Available regions: EU, US-central, SIN (optional)
     * @param  string|null $displayName Filter for Object Storage by display name. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStorageList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ListObjectStorageResponse
     */
    public function retrieveObjectStorageList($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $dataCenterName = null, $s3TenantId = null, $region = null, $displayName = null, string $contentType = self::contentTypes['retrieveObjectStorageList'][0])
    {
        list($response) = $this->retrieveObjectStorageListWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $dataCenterName, $s3TenantId, $region, $displayName, $contentType);
        return $response;
    }

    /**
     * Operation retrieveObjectStorageListWithHttpInfo
     *
     * List all your object storages
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $dataCenterName Filter for Object Storage locations. (optional)
     * @param  string|null $s3TenantId Filter for Object Storage S3 tenantId. (optional)
     * @param  string|null $region Filter for Object Storage by regions. Available regions: EU, US-central, SIN (optional)
     * @param  string|null $displayName Filter for Object Storage by display name. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStorageList'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ListObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveObjectStorageListWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $dataCenterName = null, $s3TenantId = null, $region = null, $displayName = null, string $contentType = self::contentTypes['retrieveObjectStorageList'][0])
    {
        $request = $this->retrieveObjectStorageListRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $dataCenterName, $s3TenantId, $region, $displayName, $contentType);

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
                    if ('\Contabo\Generated\Model\ListObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ListObjectStorageResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ListObjectStorageResponse', []),
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

            $returnType = '\Contabo\Generated\Model\ListObjectStorageResponse';
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
                        '\Contabo\Generated\Model\ListObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveObjectStorageListAsync
     *
     * List all your object storages
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $dataCenterName Filter for Object Storage locations. (optional)
     * @param  string|null $s3TenantId Filter for Object Storage S3 tenantId. (optional)
     * @param  string|null $region Filter for Object Storage by regions. Available regions: EU, US-central, SIN (optional)
     * @param  string|null $displayName Filter for Object Storage by display name. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStorageList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStorageListAsync($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $dataCenterName = null, $s3TenantId = null, $region = null, $displayName = null, string $contentType = self::contentTypes['retrieveObjectStorageList'][0])
    {
        return $this->retrieveObjectStorageListAsyncWithHttpInfo($xRequestId, $xTraceId, $page, $size, $orderBy, $dataCenterName, $s3TenantId, $region, $displayName, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveObjectStorageListAsyncWithHttpInfo
     *
     * List all your object storages
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $dataCenterName Filter for Object Storage locations. (optional)
     * @param  string|null $s3TenantId Filter for Object Storage S3 tenantId. (optional)
     * @param  string|null $region Filter for Object Storage by regions. Available regions: EU, US-central, SIN (optional)
     * @param  string|null $displayName Filter for Object Storage by display name. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStorageList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStorageListAsyncWithHttpInfo($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $dataCenterName = null, $s3TenantId = null, $region = null, $displayName = null, string $contentType = self::contentTypes['retrieveObjectStorageList'][0])
    {
        $returnType = '\Contabo\Generated\Model\ListObjectStorageResponse';
        $request = $this->retrieveObjectStorageListRequest($xRequestId, $xTraceId, $page, $size, $orderBy, $dataCenterName, $s3TenantId, $region, $displayName, $contentType);

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
     * Create request for operation 'retrieveObjectStorageList'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  int|null $page Number of page to be fetched. (optional)
     * @param  int|null $size Number of elements per page. (optional)
     * @param  string[]|null $orderBy Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string|null $dataCenterName Filter for Object Storage locations. (optional)
     * @param  string|null $s3TenantId Filter for Object Storage S3 tenantId. (optional)
     * @param  string|null $region Filter for Object Storage by regions. Available regions: EU, US-central, SIN (optional)
     * @param  string|null $displayName Filter for Object Storage by display name. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStorageList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveObjectStorageListRequest($xRequestId, $xTraceId = null, $page = null, $size = null, $orderBy = null, $dataCenterName = null, $s3TenantId = null, $region = null, $displayName = null, string $contentType = self::contentTypes['retrieveObjectStorageList'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrieveObjectStorageList'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling ObjectStoragesApi.retrieveObjectStorageList, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        




        if ($dataCenterName !== null && strlen($dataCenterName) < 1) {
            throw new \InvalidArgumentException('invalid length for "$dataCenterName" when calling ObjectStoragesApi.retrieveObjectStorageList, must be bigger than or equal to 1.');
        }
        




        $resourcePath = '/v1/object-storages';
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
            $dataCenterName,
            'dataCenterName', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $s3TenantId,
            's3TenantId', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $region,
            'region', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $displayName,
            'displayName', // param base name
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
     * Operation retrieveObjectStoragesStats
     *
     * List usage statistics about the specified object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStoragesStats'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\ObjectStoragesStatsResponse
     */
    public function retrieveObjectStoragesStats($xRequestId, $objectStorageId, $xTraceId = null, string $contentType = self::contentTypes['retrieveObjectStoragesStats'][0])
    {
        list($response) = $this->retrieveObjectStoragesStatsWithHttpInfo($xRequestId, $objectStorageId, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation retrieveObjectStoragesStatsWithHttpInfo
     *
     * List usage statistics about the specified object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStoragesStats'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\ObjectStoragesStatsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveObjectStoragesStatsWithHttpInfo($xRequestId, $objectStorageId, $xTraceId = null, string $contentType = self::contentTypes['retrieveObjectStoragesStats'][0])
    {
        $request = $this->retrieveObjectStoragesStatsRequest($xRequestId, $objectStorageId, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\ObjectStoragesStatsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\ObjectStoragesStatsResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\ObjectStoragesStatsResponse', []),
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

            $returnType = '\Contabo\Generated\Model\ObjectStoragesStatsResponse';
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
                        '\Contabo\Generated\Model\ObjectStoragesStatsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveObjectStoragesStatsAsync
     *
     * List usage statistics about the specified object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStoragesStats'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStoragesStatsAsync($xRequestId, $objectStorageId, $xTraceId = null, string $contentType = self::contentTypes['retrieveObjectStoragesStats'][0])
    {
        return $this->retrieveObjectStoragesStatsAsyncWithHttpInfo($xRequestId, $objectStorageId, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveObjectStoragesStatsAsyncWithHttpInfo
     *
     * List usage statistics about the specified object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStoragesStats'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStoragesStatsAsyncWithHttpInfo($xRequestId, $objectStorageId, $xTraceId = null, string $contentType = self::contentTypes['retrieveObjectStoragesStats'][0])
    {
        $returnType = '\Contabo\Generated\Model\ObjectStoragesStatsResponse';
        $request = $this->retrieveObjectStoragesStatsRequest($xRequestId, $objectStorageId, $xTraceId, $contentType);

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
     * Create request for operation 'retrieveObjectStoragesStats'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveObjectStoragesStats'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveObjectStoragesStatsRequest($xRequestId, $objectStorageId, $xTraceId = null, string $contentType = self::contentTypes['retrieveObjectStoragesStats'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling retrieveObjectStoragesStats'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling ObjectStoragesApi.retrieveObjectStoragesStats, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'objectStorageId' is set
        if ($objectStorageId === null || (is_array($objectStorageId) && count($objectStorageId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $objectStorageId when calling retrieveObjectStoragesStats'
            );
        }



        $resourcePath = '/v1/object-storages/{objectStorageId}/stats';
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
        if ($objectStorageId !== null) {
            $resourcePath = str_replace(
                '{' . 'objectStorageId' . '}',
                ObjectSerializer::toPathValue($objectStorageId),
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
     * Operation updateObjectStorage
     *
     * Modifies the display name of object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\PatchObjectStorageRequest $patchObjectStorageRequest patchObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateObjectStorage'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\CancelObjectStorageResponse
     */
    public function updateObjectStorage($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['updateObjectStorage'][0])
    {
        list($response) = $this->updateObjectStorageWithHttpInfo($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation updateObjectStorageWithHttpInfo
     *
     * Modifies the display name of object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\PatchObjectStorageRequest $patchObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateObjectStorage'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\CancelObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateObjectStorageWithHttpInfo($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['updateObjectStorage'][0])
    {
        $request = $this->updateObjectStorageRequest($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\CancelObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\CancelObjectStorageResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\CancelObjectStorageResponse', []),
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

            $returnType = '\Contabo\Generated\Model\CancelObjectStorageResponse';
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
                        '\Contabo\Generated\Model\CancelObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateObjectStorageAsync
     *
     * Modifies the display name of object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\PatchObjectStorageRequest $patchObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateObjectStorageAsync($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['updateObjectStorage'][0])
    {
        return $this->updateObjectStorageAsyncWithHttpInfo($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateObjectStorageAsyncWithHttpInfo
     *
     * Modifies the display name of object storage
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\PatchObjectStorageRequest $patchObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateObjectStorageAsyncWithHttpInfo($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['updateObjectStorage'][0])
    {
        $returnType = '\Contabo\Generated\Model\CancelObjectStorageResponse';
        $request = $this->updateObjectStorageRequest($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId, $contentType);

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
     * Create request for operation 'updateObjectStorage'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\PatchObjectStorageRequest $patchObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateObjectStorageRequest($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['updateObjectStorage'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling updateObjectStorage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling ObjectStoragesApi.updateObjectStorage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'objectStorageId' is set
        if ($objectStorageId === null || (is_array($objectStorageId) && count($objectStorageId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $objectStorageId when calling updateObjectStorage'
            );
        }

        // verify the required parameter 'patchObjectStorageRequest' is set
        if ($patchObjectStorageRequest === null || (is_array($patchObjectStorageRequest) && count($patchObjectStorageRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $patchObjectStorageRequest when calling updateObjectStorage'
            );
        }



        $resourcePath = '/v1/object-storages/{objectStorageId}';
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
        if ($objectStorageId !== null) {
            $resourcePath = str_replace(
                '{' . 'objectStorageId' . '}',
                ObjectSerializer::toPathValue($objectStorageId),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($patchObjectStorageRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($patchObjectStorageRequest));
            } else {
                $httpBody = $patchObjectStorageRequest;
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
     * Operation upgradeObjectStorage
     *
     * Upgrade object storage size resp. update autoscaling settings.
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\UpgradeObjectStorageRequest $upgradeObjectStorageRequest upgradeObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['upgradeObjectStorage'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Contabo\Generated\Model\UpgradeObjectStorageResponse
     */
    public function upgradeObjectStorage($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['upgradeObjectStorage'][0])
    {
        list($response) = $this->upgradeObjectStorageWithHttpInfo($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId, $contentType);
        return $response;
    }

    /**
     * Operation upgradeObjectStorageWithHttpInfo
     *
     * Upgrade object storage size resp. update autoscaling settings.
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\UpgradeObjectStorageRequest $upgradeObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['upgradeObjectStorage'] to see the possible values for this operation
     *
     * @throws \Contabo\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Contabo\Generated\Model\UpgradeObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function upgradeObjectStorageWithHttpInfo($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['upgradeObjectStorage'][0])
    {
        $request = $this->upgradeObjectStorageRequest($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId, $contentType);

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
                    if ('\Contabo\Generated\Model\UpgradeObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Contabo\Generated\Model\UpgradeObjectStorageResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Contabo\Generated\Model\UpgradeObjectStorageResponse', []),
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

            $returnType = '\Contabo\Generated\Model\UpgradeObjectStorageResponse';
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
                        '\Contabo\Generated\Model\UpgradeObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation upgradeObjectStorageAsync
     *
     * Upgrade object storage size resp. update autoscaling settings.
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\UpgradeObjectStorageRequest $upgradeObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['upgradeObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function upgradeObjectStorageAsync($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['upgradeObjectStorage'][0])
    {
        return $this->upgradeObjectStorageAsyncWithHttpInfo($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation upgradeObjectStorageAsyncWithHttpInfo
     *
     * Upgrade object storage size resp. update autoscaling settings.
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\UpgradeObjectStorageRequest $upgradeObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['upgradeObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function upgradeObjectStorageAsyncWithHttpInfo($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['upgradeObjectStorage'][0])
    {
        $returnType = '\Contabo\Generated\Model\UpgradeObjectStorageResponse';
        $request = $this->upgradeObjectStorageRequest($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId, $contentType);

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
     * Create request for operation 'upgradeObjectStorage'
     *
     * @param  string $xRequestId [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $objectStorageId The identifier of the object storage. (required)
     * @param  \Contabo\Generated\Model\UpgradeObjectStorageRequest $upgradeObjectStorageRequest (required)
     * @param  string|null $xTraceId Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['upgradeObjectStorage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function upgradeObjectStorageRequest($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId = null, string $contentType = self::contentTypes['upgradeObjectStorage'][0])
    {

        // verify the required parameter 'xRequestId' is set
        if ($xRequestId === null || (is_array($xRequestId) && count($xRequestId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $xRequestId when calling upgradeObjectStorage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $xRequestId)) {
            throw new \InvalidArgumentException("invalid value for \"xRequestId\" when calling ObjectStoragesApi.upgradeObjectStorage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'objectStorageId' is set
        if ($objectStorageId === null || (is_array($objectStorageId) && count($objectStorageId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $objectStorageId when calling upgradeObjectStorage'
            );
        }

        // verify the required parameter 'upgradeObjectStorageRequest' is set
        if ($upgradeObjectStorageRequest === null || (is_array($upgradeObjectStorageRequest) && count($upgradeObjectStorageRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $upgradeObjectStorageRequest when calling upgradeObjectStorage'
            );
        }



        $resourcePath = '/v1/object-storages/{objectStorageId}/resize';
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
        if ($objectStorageId !== null) {
            $resourcePath = str_replace(
                '{' . 'objectStorageId' . '}',
                ObjectSerializer::toPathValue($objectStorageId),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($upgradeObjectStorageRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($upgradeObjectStorageRequest));
            } else {
                $httpBody = $upgradeObjectStorageRequest;
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
