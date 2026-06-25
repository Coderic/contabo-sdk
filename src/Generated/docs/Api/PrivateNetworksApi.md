# Coderic\Contabo\Generated\PrivateNetworksApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**assignInstancePrivateNetwork()**](PrivateNetworksApi.md#assignInstancePrivateNetwork) | **POST** /v1/private-networks/{privateNetworkId}/instances/{instanceId} | Add instance to a Private Network |
| [**createPrivateNetwork()**](PrivateNetworksApi.md#createPrivateNetwork) | **POST** /v1/private-networks | Create a new Private Network |
| [**deletePrivateNetwork()**](PrivateNetworksApi.md#deletePrivateNetwork) | **DELETE** /v1/private-networks/{privateNetworkId} | Delete existing Private Network by id |
| [**patchPrivateNetwork()**](PrivateNetworksApi.md#patchPrivateNetwork) | **PATCH** /v1/private-networks/{privateNetworkId} | Update a Private Network by id |
| [**retrievePrivateNetwork()**](PrivateNetworksApi.md#retrievePrivateNetwork) | **GET** /v1/private-networks/{privateNetworkId} | Get specific Private Network by id |
| [**retrievePrivateNetworkList()**](PrivateNetworksApi.md#retrievePrivateNetworkList) | **GET** /v1/private-networks | List Private Networks |
| [**unassignInstancePrivateNetwork()**](PrivateNetworksApi.md#unassignInstancePrivateNetwork) | **DELETE** /v1/private-networks/{privateNetworkId}/instances/{instanceId} | Remove instance from a Private Network |


## `assignInstancePrivateNetwork()`

```php
assignInstancePrivateNetwork($xRequestId, $privateNetworkId, $instanceId, $xTraceId): \Coderic\Contabo\Generated\Model\AssignInstancePrivateNetworkResponse
```

Add instance to a Private Network

Add a specific instance to a Private Network

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$privateNetworkId = 12345; // int | The identifier of the Private Network
$instanceId = 100; // int | The identifier of the instance
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->assignInstancePrivateNetwork($xRequestId, $privateNetworkId, $instanceId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->assignInstancePrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **privateNetworkId** | **int**| The identifier of the Private Network | |
| **instanceId** | **int**| The identifier of the instance | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\AssignInstancePrivateNetworkResponse**](../Model/AssignInstancePrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createPrivateNetwork()`

```php
createPrivateNetwork($xRequestId, $createPrivateNetworkRequest, $xTraceId): \Coderic\Contabo\Generated\Model\CreatePrivateNetworkResponse
```

Create a new Private Network

Create a new Private Network in your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$createPrivateNetworkRequest = new \Coderic\Contabo\Generated\Model\CreatePrivateNetworkRequest(); // \Coderic\Contabo\Generated\Model\CreatePrivateNetworkRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createPrivateNetwork($xRequestId, $createPrivateNetworkRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->createPrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **createPrivateNetworkRequest** | [**\Coderic\Contabo\Generated\Model\CreatePrivateNetworkRequest**](../Model/CreatePrivateNetworkRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\CreatePrivateNetworkResponse**](../Model/CreatePrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deletePrivateNetwork()`

```php
deletePrivateNetwork($xRequestId, $privateNetworkId, $xTraceId)
```

Delete existing Private Network by id

Delete existing Virtual Private Cloud by id and automatically unassign all instances from it

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$privateNetworkId = 12345; // int | The identifier of the Private Network
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deletePrivateNetwork($xRequestId, $privateNetworkId, $xTraceId);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->deletePrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **privateNetworkId** | **int**| The identifier of the Private Network | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

void (empty response body)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `patchPrivateNetwork()`

```php
patchPrivateNetwork($xRequestId, $privateNetworkId, $patchPrivateNetworkRequest, $xTraceId): \Coderic\Contabo\Generated\Model\PatchPrivateNetworkResponse
```

Update a Private Network by id

Update a Private Network by id in your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$privateNetworkId = 12345; // int | The identifier of the Private Network
$patchPrivateNetworkRequest = new \Coderic\Contabo\Generated\Model\PatchPrivateNetworkRequest(); // \Coderic\Contabo\Generated\Model\PatchPrivateNetworkRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->patchPrivateNetwork($xRequestId, $privateNetworkId, $patchPrivateNetworkRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->patchPrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **privateNetworkId** | **int**| The identifier of the Private Network | |
| **patchPrivateNetworkRequest** | [**\Coderic\Contabo\Generated\Model\PatchPrivateNetworkRequest**](../Model/PatchPrivateNetworkRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\PatchPrivateNetworkResponse**](../Model/PatchPrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrievePrivateNetwork()`

```php
retrievePrivateNetwork($xRequestId, $privateNetworkId, $xTraceId): \Coderic\Contabo\Generated\Model\FindPrivateNetworkResponse
```

Get specific Private Network by id

Get attributes values to a specific Private Network on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$privateNetworkId = 12345; // int | The identifier of the Private Network
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrievePrivateNetwork($xRequestId, $privateNetworkId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->retrievePrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **privateNetworkId** | **int**| The identifier of the Private Network | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\FindPrivateNetworkResponse**](../Model/FindPrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrievePrivateNetworkList()`

```php
retrievePrivateNetworkList($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds, $region, $dataCenter): \Coderic\Contabo\Generated\Model\ListPrivateNetworkResponse
```

List Private Networks

List and filter all Private Networks in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\PrivateNetworksApi(
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
$name = myPrivateNetwork; // string | The name of the Private Network
$instanceIds = 100, 101, 102; // string | Comma separated instances identifiers
$region = EU; // string | The slug of the region where your Private Network is located
$dataCenter = European Union 1; // string | The data center where your Private Network is located

try {
    $result = $apiInstance->retrievePrivateNetworkList($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds, $region, $dataCenter);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->retrievePrivateNetworkList: ', $e->getMessage(), PHP_EOL;
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
| **name** | **string**| The name of the Private Network | [optional] |
| **instanceIds** | **string**| Comma separated instances identifiers | [optional] |
| **region** | **string**| The slug of the region where your Private Network is located | [optional] |
| **dataCenter** | **string**| The data center where your Private Network is located | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ListPrivateNetworkResponse**](../Model/ListPrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `unassignInstancePrivateNetwork()`

```php
unassignInstancePrivateNetwork($xRequestId, $privateNetworkId, $instanceId, $xTraceId): \Coderic\Contabo\Generated\Model\UnassignInstancePrivateNetworkResponse
```

Remove instance from a Private Network

Remove a specific instance from a Private Network

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$privateNetworkId = 100; // int | The identifier of the Private Network
$instanceId = 100; // int | The identifier of the instance
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->unassignInstancePrivateNetwork($xRequestId, $privateNetworkId, $instanceId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->unassignInstancePrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **privateNetworkId** | **int**| The identifier of the Private Network | |
| **instanceId** | **int**| The identifier of the instance | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\UnassignInstancePrivateNetworkResponse**](../Model/UnassignInstancePrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
