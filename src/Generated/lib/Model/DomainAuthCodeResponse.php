<?php
/**
 * DomainAuthCodeResponse
 *
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

namespace Contabo\Generated\Model;

use \ArrayAccess;
use \Contabo\Generated\ObjectSerializer;

/**
 * DomainAuthCodeResponse Class Doc Comment
 *
 * @category Class
 * @package  Contabo\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class DomainAuthCodeResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'DomainAuthCodeResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'tenantId' => 'string',
        'customerId' => 'string',
        'domain' => 'string',
        'domainDetails' => '\Contabo\Generated\Model\DomainDetails',
        'status' => 'string',
        'nameservers' => 'string[]',
        'handles' => '\Contabo\Generated\Model\DomainHandles',
        'registrationDate' => '\DateTime',
        'renewalDate' => '\DateTime',
        'terminationDate' => '\DateTime',
        'cancelDate' => '\DateTime',
        'dnssecKeys' => 'string[]',
        'transferOutConfirmation' => 'bool',
        'authCode' => 'string',
        'authCodeChanged' => '\Contabo\Generated\Model\ChangedAuthCode'
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
        'domain' => null,
        'domainDetails' => null,
        'status' => null,
        'nameservers' => null,
        'handles' => null,
        'registrationDate' => 'date-time',
        'renewalDate' => 'date-time',
        'terminationDate' => 'date-time',
        'cancelDate' => 'date-time',
        'dnssecKeys' => null,
        'transferOutConfirmation' => null,
        'authCode' => null,
        'authCodeChanged' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'tenantId' => false,
        'customerId' => false,
        'domain' => false,
        'domainDetails' => false,
        'status' => false,
        'nameservers' => false,
        'handles' => false,
        'registrationDate' => false,
        'renewalDate' => false,
        'terminationDate' => false,
        'cancelDate' => false,
        'dnssecKeys' => false,
        'transferOutConfirmation' => false,
        'authCode' => false,
        'authCodeChanged' => false
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
        'domain' => 'domain',
        'domainDetails' => 'domainDetails',
        'status' => 'status',
        'nameservers' => 'nameservers',
        'handles' => 'handles',
        'registrationDate' => 'registrationDate',
        'renewalDate' => 'renewalDate',
        'terminationDate' => 'terminationDate',
        'cancelDate' => 'cancelDate',
        'dnssecKeys' => 'dnssecKeys',
        'transferOutConfirmation' => 'transferOutConfirmation',
        'authCode' => 'authCode',
        'authCodeChanged' => 'authCodeChanged'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'tenantId' => 'setTenantId',
        'customerId' => 'setCustomerId',
        'domain' => 'setDomain',
        'domainDetails' => 'setDomainDetails',
        'status' => 'setStatus',
        'nameservers' => 'setNameservers',
        'handles' => 'setHandles',
        'registrationDate' => 'setRegistrationDate',
        'renewalDate' => 'setRenewalDate',
        'terminationDate' => 'setTerminationDate',
        'cancelDate' => 'setCancelDate',
        'dnssecKeys' => 'setDnssecKeys',
        'transferOutConfirmation' => 'setTransferOutConfirmation',
        'authCode' => 'setAuthCode',
        'authCodeChanged' => 'setAuthCodeChanged'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'tenantId' => 'getTenantId',
        'customerId' => 'getCustomerId',
        'domain' => 'getDomain',
        'domainDetails' => 'getDomainDetails',
        'status' => 'getStatus',
        'nameservers' => 'getNameservers',
        'handles' => 'getHandles',
        'registrationDate' => 'getRegistrationDate',
        'renewalDate' => 'getRenewalDate',
        'terminationDate' => 'getTerminationDate',
        'cancelDate' => 'getCancelDate',
        'dnssecKeys' => 'getDnssecKeys',
        'transferOutConfirmation' => 'getTransferOutConfirmation',
        'authCode' => 'getAuthCode',
        'authCodeChanged' => 'getAuthCodeChanged'
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

    public const STATUS_READY = 'ready';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_TRANSFERRING_IN = 'transferring in';
    public const STATUS_TRANSFERRING_OUT = 'transferring out';
    public const STATUS_MANUAL_TASK = 'manual_task';
    public const STATUS_TRANSFERRED = 'transferred';
    public const STATUS_ERROR = 'error';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_READY,
            self::STATUS_PROCESSING,
            self::STATUS_TRANSFERRING_IN,
            self::STATUS_TRANSFERRING_OUT,
            self::STATUS_MANUAL_TASK,
            self::STATUS_TRANSFERRED,
            self::STATUS_ERROR,
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
        $this->setIfExists('domain', $data ?? [], null);
        $this->setIfExists('domainDetails', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('nameservers', $data ?? [], null);
        $this->setIfExists('handles', $data ?? [], null);
        $this->setIfExists('registrationDate', $data ?? [], null);
        $this->setIfExists('renewalDate', $data ?? [], null);
        $this->setIfExists('terminationDate', $data ?? [], null);
        $this->setIfExists('cancelDate', $data ?? [], null);
        $this->setIfExists('dnssecKeys', $data ?? [], null);
        $this->setIfExists('transferOutConfirmation', $data ?? [], null);
        $this->setIfExists('authCode', $data ?? [], null);
        $this->setIfExists('authCodeChanged', $data ?? [], null);
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
        if ((mb_strlen($this->container['tenantId']) < 1)) {
            $invalidProperties[] = "invalid value for 'tenantId', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['customerId'] === null) {
            $invalidProperties[] = "'customerId' can't be null";
        }
        if ((mb_strlen($this->container['customerId']) < 1)) {
            $invalidProperties[] = "invalid value for 'customerId', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['domain'] === null) {
            $invalidProperties[] = "'domain' can't be null";
        }
        if ($this->container['domainDetails'] === null) {
            $invalidProperties[] = "'domainDetails' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['nameservers'] === null) {
            $invalidProperties[] = "'nameservers' can't be null";
        }
        if ($this->container['handles'] === null) {
            $invalidProperties[] = "'handles' can't be null";
        }
        if ($this->container['registrationDate'] === null) {
            $invalidProperties[] = "'registrationDate' can't be null";
        }
        if ($this->container['renewalDate'] === null) {
            $invalidProperties[] = "'renewalDate' can't be null";
        }
        if ($this->container['terminationDate'] === null) {
            $invalidProperties[] = "'terminationDate' can't be null";
        }
        if ($this->container['cancelDate'] === null) {
            $invalidProperties[] = "'cancelDate' can't be null";
        }
        if ($this->container['dnssecKeys'] === null) {
            $invalidProperties[] = "'dnssecKeys' can't be null";
        }
        if ($this->container['transferOutConfirmation'] === null) {
            $invalidProperties[] = "'transferOutConfirmation' can't be null";
        }
        if ($this->container['authCode'] === null) {
            $invalidProperties[] = "'authCode' can't be null";
        }
        if ($this->container['authCodeChanged'] === null) {
            $invalidProperties[] = "'authCodeChanged' can't be null";
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

        if ((mb_strlen($tenantId) < 1)) {
            throw new \InvalidArgumentException('invalid length for $tenantId when calling DomainAuthCodeResponse., must be bigger than or equal to 1.');
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
     * @param string $customerId Your customer number
     *
     * @return self
     */
    public function setCustomerId($customerId)
    {
        if (is_null($customerId)) {
            throw new \InvalidArgumentException('non-nullable customerId cannot be null');
        }

        if ((mb_strlen($customerId) < 1)) {
            throw new \InvalidArgumentException('invalid length for $customerId when calling DomainAuthCodeResponse., must be bigger than or equal to 1.');
        }

        $this->container['customerId'] = $customerId;

        return $this;
    }

    /**
     * Gets domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->container['domain'];
    }

    /**
     * Sets domain
     *
     * @param string $domain Domain name
     *
     * @return self
     */
    public function setDomain($domain)
    {
        if (is_null($domain)) {
            throw new \InvalidArgumentException('non-nullable domain cannot be null');
        }
        $this->container['domain'] = $domain;

        return $this;
    }

    /**
     * Gets domainDetails
     *
     * @return \Contabo\Generated\Model\DomainDetails
     */
    public function getDomainDetails()
    {
        return $this->container['domainDetails'];
    }

    /**
     * Sets domainDetails
     *
     * @param \Contabo\Generated\Model\DomainDetails $domainDetails Domain Details
     *
     * @return self
     */
    public function setDomainDetails($domainDetails)
    {
        if (is_null($domainDetails)) {
            throw new \InvalidArgumentException('non-nullable domainDetails cannot be null');
        }
        $this->container['domainDetails'] = $domainDetails;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status Domain Status
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets nameservers
     *
     * @return string[]
     */
    public function getNameservers()
    {
        return $this->container['nameservers'];
    }

    /**
     * Sets nameservers
     *
     * @param string[] $nameservers Nameservers
     *
     * @return self
     */
    public function setNameservers($nameservers)
    {
        if (is_null($nameservers)) {
            throw new \InvalidArgumentException('non-nullable nameservers cannot be null');
        }
        $this->container['nameservers'] = $nameservers;

        return $this;
    }

    /**
     * Gets handles
     *
     * @return \Contabo\Generated\Model\DomainHandles
     */
    public function getHandles()
    {
        return $this->container['handles'];
    }

    /**
     * Sets handles
     *
     * @param \Contabo\Generated\Model\DomainHandles $handles The handles of the domain
     *
     * @return self
     */
    public function setHandles($handles)
    {
        if (is_null($handles)) {
            throw new \InvalidArgumentException('non-nullable handles cannot be null');
        }
        $this->container['handles'] = $handles;

        return $this;
    }

    /**
     * Gets registrationDate
     *
     * @return \DateTime
     */
    public function getRegistrationDate()
    {
        return $this->container['registrationDate'];
    }

    /**
     * Sets registrationDate
     *
     * @param \DateTime $registrationDate The registration date of domain
     *
     * @return self
     */
    public function setRegistrationDate($registrationDate)
    {
        if (is_null($registrationDate)) {
            throw new \InvalidArgumentException('non-nullable registrationDate cannot be null');
        }
        $this->container['registrationDate'] = $registrationDate;

        return $this;
    }

    /**
     * Gets renewalDate
     *
     * @return \DateTime
     */
    public function getRenewalDate()
    {
        return $this->container['renewalDate'];
    }

    /**
     * Sets renewalDate
     *
     * @param \DateTime $renewalDate The renewal date of domain
     *
     * @return self
     */
    public function setRenewalDate($renewalDate)
    {
        if (is_null($renewalDate)) {
            throw new \InvalidArgumentException('non-nullable renewalDate cannot be null');
        }
        $this->container['renewalDate'] = $renewalDate;

        return $this;
    }

    /**
     * Gets terminationDate
     *
     * @return \DateTime
     */
    public function getTerminationDate()
    {
        return $this->container['terminationDate'];
    }

    /**
     * Sets terminationDate
     *
     * @param \DateTime $terminationDate The termination date of domain
     *
     * @return self
     */
    public function setTerminationDate($terminationDate)
    {
        if (is_null($terminationDate)) {
            throw new \InvalidArgumentException('non-nullable terminationDate cannot be null');
        }
        $this->container['terminationDate'] = $terminationDate;

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
     * @param \DateTime $cancelDate The cancel date of domain
     *
     * @return self
     */
    public function setCancelDate($cancelDate)
    {
        if (is_null($cancelDate)) {
            throw new \InvalidArgumentException('non-nullable cancelDate cannot be null');
        }
        $this->container['cancelDate'] = $cancelDate;

        return $this;
    }

    /**
     * Gets dnssecKeys
     *
     * @return string[]
     */
    public function getDnssecKeys()
    {
        return $this->container['dnssecKeys'];
    }

    /**
     * Sets dnssecKeys
     *
     * @param string[] $dnssecKeys DNSSEC keys
     *
     * @return self
     */
    public function setDnssecKeys($dnssecKeys)
    {
        if (is_null($dnssecKeys)) {
            throw new \InvalidArgumentException('non-nullable dnssecKeys cannot be null');
        }
        $this->container['dnssecKeys'] = $dnssecKeys;

        return $this;
    }

    /**
     * Gets transferOutConfirmation
     *
     * @return bool
     */
    public function getTransferOutConfirmation()
    {
        return $this->container['transferOutConfirmation'];
    }

    /**
     * Sets transferOutConfirmation
     *
     * @param bool $transferOutConfirmation Transfer out confirmation
     *
     * @return self
     */
    public function setTransferOutConfirmation($transferOutConfirmation)
    {
        if (is_null($transferOutConfirmation)) {
            throw new \InvalidArgumentException('non-nullable transferOutConfirmation cannot be null');
        }
        $this->container['transferOutConfirmation'] = $transferOutConfirmation;

        return $this;
    }

    /**
     * Gets authCode
     *
     * @return string
     */
    public function getAuthCode()
    {
        return $this->container['authCode'];
    }

    /**
     * Sets authCode
     *
     * @param string $authCode Your auth code of the domain
     *
     * @return self
     */
    public function setAuthCode($authCode)
    {
        if (is_null($authCode)) {
            throw new \InvalidArgumentException('non-nullable authCode cannot be null');
        }
        $this->container['authCode'] = $authCode;

        return $this;
    }

    /**
     * Gets authCodeChanged
     *
     * @return \Contabo\Generated\Model\ChangedAuthCode
     */
    public function getAuthCodeChanged()
    {
        return $this->container['authCodeChanged'];
    }

    /**
     * Sets authCodeChanged
     *
     * @param \Contabo\Generated\Model\ChangedAuthCode $authCodeChanged Details if the auth code has been changed
     *
     * @return self
     */
    public function setAuthCodeChanged($authCodeChanged)
    {
        if (is_null($authCodeChanged)) {
            throw new \InvalidArgumentException('non-nullable authCodeChanged cannot be null');
        }
        $this->container['authCodeChanged'] = $authCodeChanged;

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


