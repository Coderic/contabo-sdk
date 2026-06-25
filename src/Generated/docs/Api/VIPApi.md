# Coderic\Contabo\Generated\VIPApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**assignIp()**](VIPApi.md#assignIp) | **POST** /v1/vips/{ip}/{resourceType}/{resourceId} | Assign a VIP to an VPS/VDS/Bare Metal |
| [**retrieveVip()**](VIPApi.md#retrieveVip) | **GET** /v1/vips/{ip} | Get specific VIP by ip |
| [**retrieveVipList()**](VIPApi.md#retrieveVipList) | **GET** /v1/vips | List VIPs |
| [**unassignIp()**](VIPApi.md#unassignIp) | **DELETE** /v1/vips/{ip}/{resourceType}/{resourceId} | Unassign a VIP to a VPS/VDS/Bare Metal |


## `assignIp()`

```php
assignIp($xRequestId, $resourceId, $ip, $resourceType, $xTraceId): \Coderic\Contabo\Generated\Model\AssignVipResponse
```

Assign a VIP to an VPS/VDS/Bare Metal

Assign a VIP to a VPS/VDS/Bare Metal using the machine id.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\VIPApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$resourceId = 12345; // int | The identifier of the resource
$ip = 127.0.0.1; // string | The ip you want to add the instance to
$resourceType = instances; // string | The resourceType using the VIP.
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->assignIp($xRequestId, $resourceId, $ip, $resourceType, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VIPApi->assignIp: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **resourceId** | **int**| The identifier of the resource | |
| **ip** | **string**| The ip you want to add the instance to | |
| **resourceType** | **string**| The resourceType using the VIP. | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\AssignVipResponse**](../Model/AssignVipResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveVip()`

```php
retrieveVip($xRequestId, $ip, $xTraceId): \Coderic\Contabo\Generated\Model\FindVipResponse
```

Get specific VIP by ip

Get attributes values to a specific VIP on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\VIPApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$ip = 10.214.121.145; // string | The ip of the VIP
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveVip($xRequestId, $ip, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VIPApi->retrieveVip: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **ip** | **string**| The ip of the VIP | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\FindVipResponse**](../Model/FindVipResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveVipList()`

```php
retrieveVipList($xRequestId, $xTraceId, $page, $size, $orderBy, $resourceId, $resourceType, $resourceName, $resourceDisplayName, $ipVersion, $ips, $ip, $type, $dataCenter, $region): \Coderic\Contabo\Generated\Model\ListVipResponse
```

List VIPs

List and filter all vips in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\VIPApi(
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
$resourceId = 10001; // string | The resourceId using the VIP.
$resourceType = instances; // string | The resourceType using the VIP.
$resourceName = vmi100101; // string | The name of the resource.
$resourceDisplayName = my instance; // string | The display name of the resource.
$ipVersion = v4; // string | The VIP version.
$ips = 10.214.121.145, 10.214.121.1, 10.214.121.11; // string | Comma separated IPs
$ip = 10.214.121.145; // string | The ip of the VIP
$type = additional; // string | The VIP type.
$dataCenter = European Union (Germany) 3; // string | The dataCenter of the VIP.
$region = EU; // string | The region of the VIP.

try {
    $result = $apiInstance->retrieveVipList($xRequestId, $xTraceId, $page, $size, $orderBy, $resourceId, $resourceType, $resourceName, $resourceDisplayName, $ipVersion, $ips, $ip, $type, $dataCenter, $region);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VIPApi->retrieveVipList: ', $e->getMessage(), PHP_EOL;
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
| **resourceId** | **string**| The resourceId using the VIP. | [optional] |
| **resourceType** | **string**| The resourceType using the VIP. | [optional] |
| **resourceName** | **string**| The name of the resource. | [optional] |
| **resourceDisplayName** | **string**| The display name of the resource. | [optional] |
| **ipVersion** | **string**| The VIP version. | [optional] |
| **ips** | **string**| Comma separated IPs | [optional] |
| **ip** | **string**| The ip of the VIP | [optional] |
| **type** | **string**| The VIP type. | [optional] |
| **dataCenter** | **string**| The dataCenter of the VIP. | [optional] |
| **region** | **string**| The region of the VIP. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ListVipResponse**](../Model/ListVipResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `unassignIp()`

```php
unassignIp($xRequestId, $resourceId, $ip, $resourceType, $xTraceId)
```

Unassign a VIP to a VPS/VDS/Bare Metal

Unassign a VIP from an VPS/VDS/Bare Metal using the machine id.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\VIPApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$resourceId = 12345; // int | The identifier of the resource
$ip = 127.0.0.1; // string | The ip you want to add the instance to
$resourceType = instances; // string | The resourceType using the VIP.
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->unassignIp($xRequestId, $resourceId, $ip, $resourceType, $xTraceId);
} catch (Exception $e) {
    echo 'Exception when calling VIPApi->unassignIp: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **resourceId** | **int**| The identifier of the resource | |
| **ip** | **string**| The ip you want to add the instance to | |
| **resourceType** | **string**| The resourceType using the VIP. | |
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
