# Contabo\Generated\InstancesApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelInstance()**](InstancesApi.md#cancelInstance) | **POST** /v1/compute/instances/{instanceId}/cancel | Cancel specific instance by id |
| [**createInstance()**](InstancesApi.md#createInstance) | **POST** /v1/compute/instances | Create a new instance |
| [**patchInstance()**](InstancesApi.md#patchInstance) | **PATCH** /v1/compute/instances/{instanceId} | Update specific instance |
| [**reinstallInstance()**](InstancesApi.md#reinstallInstance) | **PUT** /v1/compute/instances/{instanceId} | Reinstall specific instance |
| [**retrieveInstance()**](InstancesApi.md#retrieveInstance) | **GET** /v1/compute/instances/{instanceId} | Get specific instance by id |
| [**retrieveInstancesList()**](InstancesApi.md#retrieveInstancesList) | **GET** /v1/compute/instances | List instances |
| [**upgradeInstance()**](InstancesApi.md#upgradeInstance) | **POST** /v1/compute/instances/{instanceId}/upgrade | Upgrading instance capabilities |


## `cancelInstance()`

```php
cancelInstance($xRequestId, $instanceId, $cancelInstanceRequest, $xTraceId): \Contabo\Generated\Model\CancelInstanceResponse
```

Cancel specific instance by id

Your are free to cancel a previously created instance at any time.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$cancelInstanceRequest = new \Contabo\Generated\Model\CancelInstanceRequest(); // \Contabo\Generated\Model\CancelInstanceRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->cancelInstance($xRequestId, $instanceId, $cancelInstanceRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->cancelInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **cancelInstanceRequest** | [**\Contabo\Generated\Model\CancelInstanceRequest**](../Model/CancelInstanceRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\CancelInstanceResponse**](../Model/CancelInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createInstance()`

```php
createInstance($xRequestId, $createInstanceRequest, $xTraceId): \Contabo\Generated\Model\CreateInstanceResponse
```

Create a new instance

Create a new instance for your account with the provided parameters.         <table>           <tr><th>ProductId</th><th>Product</th><th>Disk Size</th></tr>           <tr><td>V91</td><td>VPS 10 NVMe</td><td>75 GB NVMe</td></tr>           <tr><td>V92</td><td>VPS 10 SSD</td><td>150 GB SSD</td></tr>          <tr><td>V93</td><td>VPS 10 Storage</td><td>300 GB SSD</td></tr>          <tr><td>V94</td><td>VPS 20 NVMe</td><td>100 GB NVMe</td></tr>           <tr><td>V95</td><td>VPS 20 SSD</td><td>200 GB SSD</td></tr>          <tr><td>V96</td><td>VPS 20 Storage</td><td>400 GB SSD</td></tr>           <tr><td>V97</td><td>VPS 30 NVMe</td><td>200 GB NVMe</td></tr>           <tr><td>V98</td><td>VPS 30 SSD</td><td>400 GB SSD</td></tr>          <tr><td>V99</td><td>VPS 30 Storage</td><td>1000 GB NVMe</td></tr>           <tr><td>V100</td><td>VPS 40 NVMe</td><td>250 GB NVMe</td></tr>           <tr><td>V101</td><td>VPS 40 SSD</td><td>500 GB SSD</td></tr>           <tr><td>V102</td><td>VPS 40 Storage</td><td>1200 GB NVMe</td></tr>           <tr><td>V103</td><td>VPS 50 NVMe</td><td>300 GB NVMe</td></tr>           <tr><td>V104</td><td>VPS 50 SSD</td><td>600 GB SSD</td></tr>           <tr><td>V105</td><td>VPS 50 Storage</td><td>1400 GB SSD</td></tr>           <tr><td>V106</td><td>VPS 60 NVMe</td><td>350 GB NVMe</td></tr>           <tr><td>V107</td><td>VPS 60 SSD</td><td>700 GB SSD</td></tr>           <tr><td>V8</td><td>VDS S</td><td>180 GB NVMe</td></tr>           <tr><td>V9</td><td>VDS M</td><td>240 GB NVMe</td></tr>           <tr><td>V10</td><td>VDS L</td><td>360 GB NVMe</td></tr>           <tr><td>V11</td><td>VDS XL</td><td>480 GB NVMe</td></tr>           <tr><td>V16</td><td>VDS XXL</td><td>720 GB NVMe</td></tr>           </table>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$createInstanceRequest = new \Contabo\Generated\Model\CreateInstanceRequest(); // \Contabo\Generated\Model\CreateInstanceRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createInstance($xRequestId, $createInstanceRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->createInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **createInstanceRequest** | [**\Contabo\Generated\Model\CreateInstanceRequest**](../Model/CreateInstanceRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\CreateInstanceResponse**](../Model/CreateInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `patchInstance()`

```php
patchInstance($xRequestId, $instanceId, $patchInstanceRequest, $xTraceId): \Contabo\Generated\Model\PatchInstanceResponse
```

Update specific instance

Update specific instance by instanceId.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$patchInstanceRequest = new \Contabo\Generated\Model\PatchInstanceRequest(); // \Contabo\Generated\Model\PatchInstanceRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->patchInstance($xRequestId, $instanceId, $patchInstanceRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->patchInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **patchInstanceRequest** | [**\Contabo\Generated\Model\PatchInstanceRequest**](../Model/PatchInstanceRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\PatchInstanceResponse**](../Model/PatchInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `reinstallInstance()`

```php
reinstallInstance($xRequestId, $instanceId, $reinstallInstanceRequest, $xTraceId): \Contabo\Generated\Model\ReinstallInstanceResponse
```

Reinstall specific instance

You can reinstall a specific instance with a new image and optionally add ssh keys, a root password or cloud-init.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$reinstallInstanceRequest = new \Contabo\Generated\Model\ReinstallInstanceRequest(); // \Contabo\Generated\Model\ReinstallInstanceRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->reinstallInstance($xRequestId, $instanceId, $reinstallInstanceRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->reinstallInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **reinstallInstanceRequest** | [**\Contabo\Generated\Model\ReinstallInstanceRequest**](../Model/ReinstallInstanceRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\ReinstallInstanceResponse**](../Model/ReinstallInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveInstance()`

```php
retrieveInstance($xRequestId, $instanceId, $xTraceId): \Contabo\Generated\Model\FindInstanceResponse
```

Get specific instance by id

Get attributes values to a specific instance on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveInstance($xRequestId, $instanceId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->retrieveInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\FindInstanceResponse**](../Model/FindInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveInstancesList()`

```php
retrieveInstancesList($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $displayName, $dataCenter, $region, $instanceId, $instanceIds, $status, $productIds, $addOnIds, $productTypes, $ipConfig, $search, $customerId, $tenantId): \Contabo\Generated\Model\ListInstancesResponse
```

List instances

List and filter all instances in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$orderBy = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$name = vmd12345; // string | The name of the instance
$displayName = myTestInstance; // string | The display name of the instance
$dataCenter = European Union 1; // string | The data center of the instance
$region = EU; // string | The Region of the instance
$instanceId = 100; // int | The identifier of the instance (deprecated)
$instanceIds = 100, 101, 102; // string | Comma separated instances identifiers
$status = provisioning,installing; // string | The status of the instance
$productIds = V68,V77; // string | Identifiers of the instance products
$addOnIds = 1044,827; // string | Identifiers of Addons the instances have
$productTypes = ssd, hdd, nvme; // string | Comma separated instance's category depending on Product Id
$ipConfig = true; // bool | Filter instances that have an ip config
$search = vmd12345; // string | Full text search when listing the instances. Can be searched by `name`, `displayName`, `ipAddress`
$customerId = 22223; // string | Filter by customer ID
$tenantId = DE; // string | Filter by tenant ID

try {
    $result = $apiInstance->retrieveInstancesList($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $displayName, $dataCenter, $region, $instanceId, $instanceIds, $status, $productIds, $addOnIds, $productTypes, $ipConfig, $search, $customerId, $tenantId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->retrieveInstancesList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **orderBy** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **name** | **string**| The name of the instance | [optional] |
| **displayName** | **string**| The display name of the instance | [optional] |
| **dataCenter** | **string**| The data center of the instance | [optional] |
| **region** | **string**| The Region of the instance | [optional] |
| **instanceId** | **int**| The identifier of the instance (deprecated) | [optional] |
| **instanceIds** | **string**| Comma separated instances identifiers | [optional] |
| **status** | **string**| The status of the instance | [optional] |
| **productIds** | **string**| Identifiers of the instance products | [optional] |
| **addOnIds** | **string**| Identifiers of Addons the instances have | [optional] |
| **productTypes** | **string**| Comma separated instance&#39;s category depending on Product Id | [optional] |
| **ipConfig** | **bool**| Filter instances that have an ip config | [optional] |
| **search** | **string**| Full text search when listing the instances. Can be searched by &#x60;name&#x60;, &#x60;displayName&#x60;, &#x60;ipAddress&#x60; | [optional] |
| **customerId** | **string**| Filter by customer ID | [optional] |
| **tenantId** | **string**| Filter by tenant ID | [optional] |

### Return type

[**\Contabo\Generated\Model\ListInstancesResponse**](../Model/ListInstancesResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `upgradeInstance()`

```php
upgradeInstance($xRequestId, $instanceId, $upgradeInstanceRequest, $xTraceId): \Contabo\Generated\Model\PatchInstanceResponse
```

Upgrading instance capabilities

In order to enhance your instance with additional features you can purchase add-ons.   Currently only firewalling and private network addon is allowed.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$upgradeInstanceRequest = new \Contabo\Generated\Model\UpgradeInstanceRequest(); // \Contabo\Generated\Model\UpgradeInstanceRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->upgradeInstance($xRequestId, $instanceId, $upgradeInstanceRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->upgradeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **upgradeInstanceRequest** | [**\Contabo\Generated\Model\UpgradeInstanceRequest**](../Model/UpgradeInstanceRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\PatchInstanceResponse**](../Model/PatchInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
