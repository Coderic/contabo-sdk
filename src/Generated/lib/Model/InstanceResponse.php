<?php
/**
 * InstanceResponse
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  Coderic\Contabo\Generated
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

namespace Coderic\Contabo\Generated\Model;

use \ArrayAccess;
use \Coderic\Contabo\Generated\ObjectSerializer;

/**
 * InstanceResponse Class Doc Comment
 *
 * @category Class
 * @package  Coderic\Contabo\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class InstanceResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InstanceResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'tenantId' => 'string',
        'customerId' => 'string',
        'additionalIps' => '\Coderic\Contabo\Generated\Model\AdditionalIp[]',
        'name' => 'string',
        'displayName' => 'string',
        'instanceId' => 'int',
        'dataCenter' => 'string',
        'region' => 'string',
        'regionName' => 'string',
        'productId' => 'string',
        'imageId' => 'string',
        'ipConfig' => '\Coderic\Contabo\Generated\Model\IpConfig2',
        'macAddress' => 'string',
        'ramMb' => 'float',
        'cpuCores' => 'int',
        'osType' => 'string',
        'diskMb' => 'float',
        'sshKeys' => 'int[]',
        'createdDate' => '\DateTime',
        'cancelDate' => '\DateTime',
        'status' => '\Coderic\Contabo\Generated\Model\InstanceStatus',
        'vHostId' => 'int',
        'vHostNumber' => 'int',
        'vHostName' => 'string',
        'addOns' => '\Coderic\Contabo\Generated\Model\AddOnResponse[]',
        'errorMessage' => 'string',
        'productType' => 'string',
        'productName' => 'string',
        'defaultUser' => 'string',
        'applicationId' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'tenantId' => null,
        'customerId' => null,
        'additionalIps' => null,
        'name' => null,
        'displayName' => null,
        'instanceId' => 'int64',
        'dataCenter' => null,
        'region' => null,
        'regionName' => null,
        'productId' => null,
        'imageId' => null,
        'ipConfig' => null,
        'macAddress' => null,
        'ramMb' => null,
        'cpuCores' => 'int64',
        'osType' => null,
        'diskMb' => null,
        'sshKeys' => 'int64',
        'createdDate' => 'date-time',
        'cancelDate' => 'date',
        'status' => null,
        'vHostId' => 'int64',
        'vHostNumber' => 'int64',
        'vHostName' => null,
        'addOns' => null,
        'errorMessage' => null,
        'productType' => null,
        'productName' => null,
        'defaultUser' => null,
        'applicationId' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'tenantId' => false,
        'customerId' => false,
        'additionalIps' => false,
        'name' => false,
        'displayName' => false,
        'instanceId' => false,
        'dataCenter' => false,
        'region' => false,
        'regionName' => false,
        'productId' => false,
        'imageId' => false,
        'ipConfig' => false,
        'macAddress' => false,
        'ramMb' => false,
        'cpuCores' => false,
        'osType' => false,
        'diskMb' => false,
        'sshKeys' => false,
        'createdDate' => false,
        'cancelDate' => false,
        'status' => false,
        'vHostId' => false,
        'vHostNumber' => false,
        'vHostName' => false,
        'addOns' => false,
        'errorMessage' => false,
        'productType' => false,
        'productName' => false,
        'defaultUser' => false,
        'applicationId' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'tenantId' => 'tenantId',
        'customerId' => 'customerId',
        'additionalIps' => 'additionalIps',
        'name' => 'name',
        'displayName' => 'displayName',
        'instanceId' => 'instanceId',
        'dataCenter' => 'dataCenter',
        'region' => 'region',
        'regionName' => 'regionName',
        'productId' => 'productId',
        'imageId' => 'imageId',
        'ipConfig' => 'ipConfig',
        'macAddress' => 'macAddress',
        'ramMb' => 'ramMb',
        'cpuCores' => 'cpuCores',
        'osType' => 'osType',
        'diskMb' => 'diskMb',
        'sshKeys' => 'sshKeys',
        'createdDate' => 'createdDate',
        'cancelDate' => 'cancelDate',
        'status' => 'status',
        'vHostId' => 'vHostId',
        'vHostNumber' => 'vHostNumber',
        'vHostName' => 'vHostName',
        'addOns' => 'addOns',
        'errorMessage' => 'errorMessage',
        'productType' => 'productType',
        'productName' => 'productName',
        'defaultUser' => 'defaultUser',
        'applicationId' => 'applicationId'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'tenantId' => 'setTenantId',
        'customerId' => 'setCustomerId',
        'additionalIps' => 'setAdditionalIps',
        'name' => 'setName',
        'displayName' => 'setDisplayName',
        'instanceId' => 'setInstanceId',
        'dataCenter' => 'setDataCenter',
        'region' => 'setRegion',
        'regionName' => 'setRegionName',
        'productId' => 'setProductId',
        'imageId' => 'setImageId',
        'ipConfig' => 'setIpConfig',
        'macAddress' => 'setMacAddress',
        'ramMb' => 'setRamMb',
        'cpuCores' => 'setCpuCores',
        'osType' => 'setOsType',
        'diskMb' => 'setDiskMb',
        'sshKeys' => 'setSshKeys',
        'createdDate' => 'setCreatedDate',
        'cancelDate' => 'setCancelDate',
        'status' => 'setStatus',
        'vHostId' => 'setVHostId',
        'vHostNumber' => 'setVHostNumber',
        'vHostName' => 'setVHostName',
        'addOns' => 'setAddOns',
        'errorMessage' => 'setErrorMessage',
        'productType' => 'setProductType',
        'productName' => 'setProductName',
        'defaultUser' => 'setDefaultUser',
        'applicationId' => 'setApplicationId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'tenantId' => 'getTenantId',
        'customerId' => 'getCustomerId',
        'additionalIps' => 'getAdditionalIps',
        'name' => 'getName',
        'displayName' => 'getDisplayName',
        'instanceId' => 'getInstanceId',
        'dataCenter' => 'getDataCenter',
        'region' => 'getRegion',
        'regionName' => 'getRegionName',
        'productId' => 'getProductId',
        'imageId' => 'getImageId',
        'ipConfig' => 'getIpConfig',
        'macAddress' => 'getMacAddress',
        'ramMb' => 'getRamMb',
        'cpuCores' => 'getCpuCores',
        'osType' => 'getOsType',
        'diskMb' => 'getDiskMb',
        'sshKeys' => 'getSshKeys',
        'createdDate' => 'getCreatedDate',
        'cancelDate' => 'getCancelDate',
        'status' => 'getStatus',
        'vHostId' => 'getVHostId',
        'vHostNumber' => 'getVHostNumber',
        'vHostName' => 'getVHostName',
        'addOns' => 'getAddOns',
        'errorMessage' => 'getErrorMessage',
        'productType' => 'getProductType',
        'productName' => 'getProductName',
        'defaultUser' => 'getDefaultUser',
        'applicationId' => 'getApplicationId'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    public const TENANT_ID_DE = 'DE';
    public const TENANT_ID_INT = 'INT';
    public const PRODUCT_TYPE_HDD = 'hdd';
    public const PRODUCT_TYPE_SSD = 'ssd';
    public const PRODUCT_TYPE_VDS = 'vds';
    public const PRODUCT_TYPE_NVME = 'nvme';
    public const DEFAULT_USER_ROOT = 'root';
    public const DEFAULT_USER_ADMIN = 'admin';
    public const DEFAULT_USER_ADMINISTRATOR = 'administrator';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTenantIdAllowableValues()
    {
        return [
            self::TENANT_ID_DE,
            self::TENANT_ID_INT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProductTypeAllowableValues()
    {
        return [
            self::PRODUCT_TYPE_HDD,
            self::PRODUCT_TYPE_SSD,
            self::PRODUCT_TYPE_VDS,
            self::PRODUCT_TYPE_NVME,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDefaultUserAllowableValues()
    {
        return [
            self::DEFAULT_USER_ROOT,
            self::DEFAULT_USER_ADMIN,
            self::DEFAULT_USER_ADMINISTRATOR,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[]|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('tenantId', $data ?? [], null);
        $this->setIfExists('customerId', $data ?? [], null);
        $this->setIfExists('additionalIps', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('displayName', $data ?? [], null);
        $this->setIfExists('instanceId', $data ?? [], null);
        $this->setIfExists('dataCenter', $data ?? [], null);
        $this->setIfExists('region', $data ?? [], null);
        $this->setIfExists('regionName', $data ?? [], null);
        $this->setIfExists('productId', $data ?? [], null);
        $this->setIfExists('imageId', $data ?? [], null);
        $this->setIfExists('ipConfig', $data ?? [], null);
        $this->setIfExists('macAddress', $data ?? [], null);
        $this->setIfExists('ramMb', $data ?? [], null);
        $this->setIfExists('cpuCores', $data ?? [], null);
        $this->setIfExists('osType', $data ?? [], null);
        $this->setIfExists('diskMb', $data ?? [], null);
        $this->setIfExists('sshKeys', $data ?? [], null);
        $this->setIfExists('createdDate', $data ?? [], null);
        $this->setIfExists('cancelDate', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('vHostId', $data ?? [], null);
        $this->setIfExists('vHostNumber', $data ?? [], null);
        $this->setIfExists('vHostName', $data ?? [], null);
        $this->setIfExists('addOns', $data ?? [], null);
        $this->setIfExists('errorMessage', $data ?? [], null);
        $this->setIfExists('productType', $data ?? [], null);
        $this->setIfExists('productName', $data ?? [], null);
        $this->setIfExists('defaultUser', $data ?? [], null);
        $this->setIfExists('applicationId', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['tenantId'] === null) {
            $invalidProperties[] = "'tenantId' can't be null";
        }
        $allowedValues = $this->getTenantIdAllowableValues();
        if (!is_null($this->container['tenantId']) && !in_array($this->container['tenantId'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'tenantId', must be one of '%s'",
                $this->container['tenantId'],
                implode("', '", $allowedValues)
            );
        }

        if ((mb_strlen($this->container['tenantId']) < 1)) {
            $invalidProperties[] = "invalid value for 'tenantId', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['customerId'] === null) {
            $invalidProperties[] = "'customerId' can't be null";
        }
        if ((mb_strlen($this->container['customerId']) < 1)) {
            $invalidProperties[] = "invalid value for 'customerId', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['additionalIps'] === null) {
            $invalidProperties[] = "'additionalIps' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['displayName'] === null) {
            $invalidProperties[] = "'displayName' can't be null";
        }
        if ($this->container['instanceId'] === null) {
            $invalidProperties[] = "'instanceId' can't be null";
        }
        if ($this->container['dataCenter'] === null) {
            $invalidProperties[] = "'dataCenter' can't be null";
        }
        if ($this->container['region'] === null) {
            $invalidProperties[] = "'region' can't be null";
        }
        if ($this->container['regionName'] === null) {
            $invalidProperties[] = "'regionName' can't be null";
        }
        if ($this->container['productId'] === null) {
            $invalidProperties[] = "'productId' can't be null";
        }
        if ($this->container['imageId'] === null) {
            $invalidProperties[] = "'imageId' can't be null";
        }
        if ($this->container['ipConfig'] === null) {
            $invalidProperties[] = "'ipConfig' can't be null";
        }
        if ($this->container['macAddress'] === null) {
            $invalidProperties[] = "'macAddress' can't be null";
        }
        if ($this->container['ramMb'] === null) {
            $invalidProperties[] = "'ramMb' can't be null";
        }
        if ($this->container['cpuCores'] === null) {
            $invalidProperties[] = "'cpuCores' can't be null";
        }
        if ($this->container['osType'] === null) {
            $invalidProperties[] = "'osType' can't be null";
        }
        if ($this->container['diskMb'] === null) {
            $invalidProperties[] = "'diskMb' can't be null";
        }
        if ($this->container['sshKeys'] === null) {
            $invalidProperties[] = "'sshKeys' can't be null";
        }
        if ($this->container['createdDate'] === null) {
            $invalidProperties[] = "'createdDate' can't be null";
        }
        if ($this->container['cancelDate'] === null) {
            $invalidProperties[] = "'cancelDate' can't be null";
        }
        if ((mb_strlen($this->container['cancelDate']) > 10)) {
            $invalidProperties[] = "invalid value for 'cancelDate', the character length must be smaller than or equal to 10.";
        }

        if ((mb_strlen($this->container['cancelDate']) < 0)) {
            $invalidProperties[] = "invalid value for 'cancelDate', the character length must be bigger than or equal to 0.";
        }

        if (!preg_match("/yyyy-mm-dd/", $this->container['cancelDate'])) {
            $invalidProperties[] = "invalid value for 'cancelDate', must be conform to the pattern /yyyy-mm-dd/.";
        }

        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        if ($this->container['vHostId'] === null) {
            $invalidProperties[] = "'vHostId' can't be null";
        }
        if ($this->container['vHostNumber'] === null) {
            $invalidProperties[] = "'vHostNumber' can't be null";
        }
        if ($this->container['vHostName'] === null) {
            $invalidProperties[] = "'vHostName' can't be null";
        }
        if ($this->container['addOns'] === null) {
            $invalidProperties[] = "'addOns' can't be null";
        }
        if ($this->container['productType'] === null) {
            $invalidProperties[] = "'productType' can't be null";
        }
        $allowedValues = $this->getProductTypeAllowableValues();
        if (!is_null($this->container['productType']) && !in_array($this->container['productType'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'productType', must be one of '%s'",
                $this->container['productType'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['productName'] === null) {
            $invalidProperties[] = "'productName' can't be null";
        }
        $allowedValues = $this->getDefaultUserAllowableValues();
        if (!is_null($this->container['defaultUser']) && !in_array($this->container['defaultUser'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'defaultUser', must be one of '%s'",
                $this->container['defaultUser'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['applicationId'] === null) {
            $invalidProperties[] = "'applicationId' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets tenantId
     *
     * @return string
     */
    public function getTenantId()
    {
        return $this->container['tenantId'];
    }

    /**
     * Sets tenantId
     *
     * @param string $tenantId Your customer tenant id
     *
     * @return self
     */
    public function setTenantId($tenantId)
    {
        if (is_null($tenantId)) {
            throw new \InvalidArgumentException('non-nullable tenantId cannot be null');
        }
        $allowedValues = $this->getTenantIdAllowableValues();
        if (!in_array($tenantId, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'tenantId', must be one of '%s'",
                    $tenantId,
                    implode("', '", $allowedValues)
                )
            );
        }

        if ((mb_strlen($tenantId) < 1)) {
            throw new \InvalidArgumentException('invalid length for $tenantId when calling InstanceResponse., must be bigger than or equal to 1.');
        }

        $this->container['tenantId'] = $tenantId;

        return $this;
    }

    /**
     * Gets customerId
     *
     * @return string
     */
    public function getCustomerId()
    {
        return $this->container['customerId'];
    }

    /**
     * Sets customerId
     *
     * @param string $customerId Customer ID
     *
     * @return self
     */
    public function setCustomerId($customerId)
    {
        if (is_null($customerId)) {
            throw new \InvalidArgumentException('non-nullable customerId cannot be null');
        }

        if ((mb_strlen($customerId) < 1)) {
            throw new \InvalidArgumentException('invalid length for $customerId when calling InstanceResponse., must be bigger than or equal to 1.');
        }

        $this->container['customerId'] = $customerId;

        return $this;
    }

    /**
     * Gets additionalIps
     *
     * @return \Coderic\Contabo\Generated\Model\AdditionalIp[]
     */
    public function getAdditionalIps()
    {
        return $this->container['additionalIps'];
    }

    /**
     * Sets additionalIps
     *
     * @param \Coderic\Contabo\Generated\Model\AdditionalIp[] $additionalIps additionalIps
     *
     * @return self
     */
    public function setAdditionalIps($additionalIps)
    {
        if (is_null($additionalIps)) {
            throw new \InvalidArgumentException('non-nullable additionalIps cannot be null');
        }
        $this->container['additionalIps'] = $additionalIps;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Instance Name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container['displayName'];
    }

    /**
     * Sets displayName
     *
     * @param string $displayName Instance display name
     *
     * @return self
     */
    public function setDisplayName($displayName)
    {
        if (is_null($displayName)) {
            throw new \InvalidArgumentException('non-nullable displayName cannot be null');
        }
        $this->container['displayName'] = $displayName;

        return $this;
    }

    /**
     * Gets instanceId
     *
     * @return int
     */
    public function getInstanceId()
    {
        return $this->container['instanceId'];
    }

    /**
     * Sets instanceId
     *
     * @param int $instanceId Instance ID
     *
     * @return self
     */
    public function setInstanceId($instanceId)
    {
        if (is_null($instanceId)) {
            throw new \InvalidArgumentException('non-nullable instanceId cannot be null');
        }
        $this->container['instanceId'] = $instanceId;

        return $this;
    }

    /**
     * Gets dataCenter
     *
     * @return string
     */
    public function getDataCenter()
    {
        return $this->container['dataCenter'];
    }

    /**
     * Sets dataCenter
     *
     * @param string $dataCenter The data center where your Private Network is located
     *
     * @return self
     */
    public function setDataCenter($dataCenter)
    {
        if (is_null($dataCenter)) {
            throw new \InvalidArgumentException('non-nullable dataCenter cannot be null');
        }
        $this->container['dataCenter'] = $dataCenter;

        return $this;
    }

    /**
     * Gets region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->container['region'];
    }

    /**
     * Sets region
     *
     * @param string $region Instance region where the compute instance should be located.
     *
     * @return self
     */
    public function setRegion($region)
    {
        if (is_null($region)) {
            throw new \InvalidArgumentException('non-nullable region cannot be null');
        }
        $this->container['region'] = $region;

        return $this;
    }

    /**
     * Gets regionName
     *
     * @return string
     */
    public function getRegionName()
    {
        return $this->container['regionName'];
    }

    /**
     * Sets regionName
     *
     * @param string $regionName The name of the region where the instance is located.
     *
     * @return self
     */
    public function setRegionName($regionName)
    {
        if (is_null($regionName)) {
            throw new \InvalidArgumentException('non-nullable regionName cannot be null');
        }
        $this->container['regionName'] = $regionName;

        return $this;
    }

    /**
     * Gets productId
     *
     * @return string
     */
    public function getProductId()
    {
        return $this->container['productId'];
    }

    /**
     * Sets productId
     *
     * @param string $productId Product ID
     *
     * @return self
     */
    public function setProductId($productId)
    {
        if (is_null($productId)) {
            throw new \InvalidArgumentException('non-nullable productId cannot be null');
        }
        $this->container['productId'] = $productId;

        return $this;
    }

    /**
     * Gets imageId
     *
     * @return string
     */
    public function getImageId()
    {
        return $this->container['imageId'];
    }

    /**
     * Sets imageId
     *
     * @param string $imageId Image's id
     *
     * @return self
     */
    public function setImageId($imageId)
    {
        if (is_null($imageId)) {
            throw new \InvalidArgumentException('non-nullable imageId cannot be null');
        }
        $this->container['imageId'] = $imageId;

        return $this;
    }

    /**
     * Gets ipConfig
     *
     * @return \Coderic\Contabo\Generated\Model\IpConfig2
     */
    public function getIpConfig()
    {
        return $this->container['ipConfig'];
    }

    /**
     * Sets ipConfig
     *
     * @param \Coderic\Contabo\Generated\Model\IpConfig2 $ipConfig ipConfig
     *
     * @return self
     */
    public function setIpConfig($ipConfig)
    {
        if (is_null($ipConfig)) {
            throw new \InvalidArgumentException('non-nullable ipConfig cannot be null');
        }
        $this->container['ipConfig'] = $ipConfig;

        return $this;
    }

    /**
     * Gets macAddress
     *
     * @return string
     */
    public function getMacAddress()
    {
        return $this->container['macAddress'];
    }

    /**
     * Sets macAddress
     *
     * @param string $macAddress MAC Address
     *
     * @return self
     */
    public function setMacAddress($macAddress)
    {
        if (is_null($macAddress)) {
            throw new \InvalidArgumentException('non-nullable macAddress cannot be null');
        }
        $this->container['macAddress'] = $macAddress;

        return $this;
    }

    /**
     * Gets ramMb
     *
     * @return float
     */
    public function getRamMb()
    {
        return $this->container['ramMb'];
    }

    /**
     * Sets ramMb
     *
     * @param float $ramMb Image RAM size in MB
     *
     * @return self
     */
    public function setRamMb($ramMb)
    {
        if (is_null($ramMb)) {
            throw new \InvalidArgumentException('non-nullable ramMb cannot be null');
        }
        $this->container['ramMb'] = $ramMb;

        return $this;
    }

    /**
     * Gets cpuCores
     *
     * @return int
     */
    public function getCpuCores()
    {
        return $this->container['cpuCores'];
    }

    /**
     * Sets cpuCores
     *
     * @param int $cpuCores CPU core count
     *
     * @return self
     */
    public function setCpuCores($cpuCores)
    {
        if (is_null($cpuCores)) {
            throw new \InvalidArgumentException('non-nullable cpuCores cannot be null');
        }
        $this->container['cpuCores'] = $cpuCores;

        return $this;
    }

    /**
     * Gets osType
     *
     * @return string
     */
    public function getOsType()
    {
        return $this->container['osType'];
    }

    /**
     * Sets osType
     *
     * @param string $osType Type of operating system (OS)
     *
     * @return self
     */
    public function setOsType($osType)
    {
        if (is_null($osType)) {
            throw new \InvalidArgumentException('non-nullable osType cannot be null');
        }
        $this->container['osType'] = $osType;

        return $this;
    }

    /**
     * Gets diskMb
     *
     * @return float
     */
    public function getDiskMb()
    {
        return $this->container['diskMb'];
    }

    /**
     * Sets diskMb
     *
     * @param float $diskMb Image Disk size in MB
     *
     * @return self
     */
    public function setDiskMb($diskMb)
    {
        if (is_null($diskMb)) {
            throw new \InvalidArgumentException('non-nullable diskMb cannot be null');
        }
        $this->container['diskMb'] = $diskMb;

        return $this;
    }

    /**
     * Gets sshKeys
     *
     * @return int[]
     */
    public function getSshKeys()
    {
        return $this->container['sshKeys'];
    }

    /**
     * Sets sshKeys
     *
     * @param int[] $sshKeys Array of `secretId`s of public SSH keys for logging into as `defaultUser` with administrator/root privileges. Applies to Linux/BSD systems. Please refer to Secrets Management API.
     *
     * @return self
     */
    public function setSshKeys($sshKeys)
    {
        if (is_null($sshKeys)) {
            throw new \InvalidArgumentException('non-nullable sshKeys cannot be null');
        }
        $this->container['sshKeys'] = $sshKeys;

        return $this;
    }

    /**
     * Gets createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->container['createdDate'];
    }

    /**
     * Sets createdDate
     *
     * @param \DateTime $createdDate The creation date for the instance
     *
     * @return self
     */
    public function setCreatedDate($createdDate)
    {
        if (is_null($createdDate)) {
            throw new \InvalidArgumentException('non-nullable createdDate cannot be null');
        }
        $this->container['createdDate'] = $createdDate;

        return $this;
    }

    /**
     * Gets cancelDate
     *
     * @return \DateTime
     */
    public function getCancelDate()
    {
        return $this->container['cancelDate'];
    }

    /**
     * Sets cancelDate
     *
     * @param \DateTime $cancelDate The date on which the instance will be cancelled
     *
     * @return self
     */
    public function setCancelDate($cancelDate)
    {
        if (is_null($cancelDate)) {
            throw new \InvalidArgumentException('non-nullable cancelDate cannot be null');
        }
        if ((mb_strlen($cancelDate) > 10)) {
            throw new \InvalidArgumentException('invalid length for $cancelDate when calling InstanceResponse., must be smaller than or equal to 10.');
        }
        if ((mb_strlen($cancelDate) < 0)) {
            throw new \InvalidArgumentException('invalid length for $cancelDate when calling InstanceResponse., must be bigger than or equal to 0.');
        }
        if ((!preg_match("/yyyy-mm-dd/", ObjectSerializer::toString($cancelDate)))) {
            throw new \InvalidArgumentException("invalid value for \$cancelDate when calling InstanceResponse., must conform to the pattern /yyyy-mm-dd/.");
        }

        $this->container['cancelDate'] = $cancelDate;

        return $this;
    }

    /**
     * Gets status
     *
     * @return \Coderic\Contabo\Generated\Model\InstanceStatus
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param \Coderic\Contabo\Generated\Model\InstanceStatus $status Instance's status
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets vHostId
     *
     * @return int
     */
    public function getVHostId()
    {
        return $this->container['vHostId'];
    }

    /**
     * Sets vHostId
     *
     * @param int $vHostId ID of host system
     *
     * @return self
     */
    public function setVHostId($vHostId)
    {
        if (is_null($vHostId)) {
            throw new \InvalidArgumentException('non-nullable vHostId cannot be null');
        }
        $this->container['vHostId'] = $vHostId;

        return $this;
    }

    /**
     * Gets vHostNumber
     *
     * @return int
     */
    public function getVHostNumber()
    {
        return $this->container['vHostNumber'];
    }

    /**
     * Sets vHostNumber
     *
     * @param int $vHostNumber Number of host system
     *
     * @return self
     */
    public function setVHostNumber($vHostNumber)
    {
        if (is_null($vHostNumber)) {
            throw new \InvalidArgumentException('non-nullable vHostNumber cannot be null');
        }
        $this->container['vHostNumber'] = $vHostNumber;

        return $this;
    }

    /**
     * Gets vHostName
     *
     * @return string
     */
    public function getVHostName()
    {
        return $this->container['vHostName'];
    }

    /**
     * Sets vHostName
     *
     * @param string $vHostName Name of host system
     *
     * @return self
     */
    public function setVHostName($vHostName)
    {
        if (is_null($vHostName)) {
            throw new \InvalidArgumentException('non-nullable vHostName cannot be null');
        }
        $this->container['vHostName'] = $vHostName;

        return $this;
    }

    /**
     * Gets addOns
     *
     * @return \Coderic\Contabo\Generated\Model\AddOnResponse[]
     */
    public function getAddOns()
    {
        return $this->container['addOns'];
    }

    /**
     * Sets addOns
     *
     * @param \Coderic\Contabo\Generated\Model\AddOnResponse[] $addOns addOns
     *
     * @return self
     */
    public function setAddOns($addOns)
    {
        if (is_null($addOns)) {
            throw new \InvalidArgumentException('non-nullable addOns cannot be null');
        }
        $this->container['addOns'] = $addOns;

        return $this;
    }

    /**
     * Gets errorMessage
     *
     * @return string|null
     */
    public function getErrorMessage()
    {
        return $this->container['errorMessage'];
    }

    /**
     * Sets errorMessage
     *
     * @param string|null $errorMessage Message in case of an error.
     *
     * @return self
     */
    public function setErrorMessage($errorMessage)
    {
        if (is_null($errorMessage)) {
            throw new \InvalidArgumentException('non-nullable errorMessage cannot be null');
        }
        $this->container['errorMessage'] = $errorMessage;

        return $this;
    }

    /**
     * Gets productType
     *
     * @return string
     */
    public function getProductType()
    {
        return $this->container['productType'];
    }

    /**
     * Sets productType
     *
     * @param string $productType Instance's category depending on Product Id
     *
     * @return self
     */
    public function setProductType($productType)
    {
        if (is_null($productType)) {
            throw new \InvalidArgumentException('non-nullable productType cannot be null');
        }
        $allowedValues = $this->getProductTypeAllowableValues();
        if (!in_array($productType, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'productType', must be one of '%s'",
                    $productType,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['productType'] = $productType;

        return $this;
    }

    /**
     * Gets productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->container['productName'];
    }

    /**
     * Sets productName
     *
     * @param string $productName Instance's Product Name
     *
     * @return self
     */
    public function setProductName($productName)
    {
        if (is_null($productName)) {
            throw new \InvalidArgumentException('non-nullable productName cannot be null');
        }
        $this->container['productName'] = $productName;

        return $this;
    }

    /**
     * Gets defaultUser
     *
     * @return string|null
     */
    public function getDefaultUser()
    {
        return $this->container['defaultUser'];
    }

    /**
     * Sets defaultUser
     *
     * @param string|null $defaultUser Default user name created for login during (re-)installation with administrative privileges. Allowed values for Linux/BSD are `admin` (use sudo to apply administrative privileges like root) or `root`. Allowed values for Windows are `admin` (has administrative privileges like administrator) or `administrator`.
     *
     * @return self
     */
    public function setDefaultUser($defaultUser)
    {
        if (is_null($defaultUser)) {
            throw new \InvalidArgumentException('non-nullable defaultUser cannot be null');
        }
        $allowedValues = $this->getDefaultUserAllowableValues();
        if (!in_array($defaultUser, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'defaultUser', must be one of '%s'",
                    $defaultUser,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['defaultUser'] = $defaultUser;

        return $this;
    }

    /**
     * Gets applicationId
     *
     * @return string
     */
    public function getApplicationId()
    {
        return $this->container['applicationId'];
    }

    /**
     * Sets applicationId
     *
     * @param string $applicationId Application ID
     *
     * @return self
     */
    public function setApplicationId($applicationId)
    {
        if (is_null($applicationId)) {
            throw new \InvalidArgumentException('non-nullable applicationId cannot be null');
        }
        $this->container['applicationId'] = $applicationId;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


