# Contabo\Generated\ChecksApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelExtCheck()**](ChecksApi.md#cancelExtCheck) | **PATCH** /v1/troubleshooting/checks/{checkId} | Cancel check |
| [**getExtCheck()**](ChecksApi.md#getExtCheck) | **GET** /v1/troubleshooting/checks/{checkId} | Get check |
| [**listExtChecks()**](ChecksApi.md#listExtChecks) | **GET** /v1/troubleshooting/checks | List check |
| [**startExtCheck()**](ChecksApi.md#startExtCheck) | **POST** /v1/troubleshooting/checks | Start check |


## `cancelExtCheck()`

```php
cancelExtCheck($xRequestId, $checkId, $cancelRequest, $xTraceId): \Contabo\Generated\Model\ExtChecksGetResponse
```

Cancel check

Cancel check

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ChecksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkId = 12345; // float | Check's id
$cancelRequest = new \Contabo\Generated\Model\CancelRequest(); // \Contabo\Generated\Model\CancelRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->cancelExtCheck($xRequestId, $checkId, $cancelRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChecksApi->cancelExtCheck: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkId** | **float**| Check&#39;s id | |
| **cancelRequest** | [**\Contabo\Generated\Model\CancelRequest**](../Model/CancelRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\ExtChecksGetResponse**](../Model/ExtChecksGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getExtCheck()`

```php
getExtCheck($xRequestId, $checkId, $xTraceId): \Contabo\Generated\Model\ExtChecksGetResponse
```

Get check

Get a single check by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ChecksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkId = 12345; // float | Check's id
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->getExtCheck($xRequestId, $checkId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChecksApi->getExtCheck: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkId** | **float**| Check&#39;s id | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\ExtChecksGetResponse**](../Model/ExtChecksGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listExtChecks()`

```php
listExtChecks($xRequestId, $xTraceId, $objectType, $objectId, $status, $checkCollectionId, $checkTemplateId): \Contabo\Generated\Model\ExtChecksListResponse
```

List check

List and filter all check

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ChecksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.
$objectType = vserver; // string | Object type to be handled
$objectId = 4711; // string | ID of the object, to be handled
$status = failed; // string | Status of the handle
$checkCollectionId = 12345; // float | ID of check collection if started in scope of a collection
$checkTemplateId = 12345; // float | Check Template for this check

try {
    $result = $apiInstance->listExtChecks($xRequestId, $xTraceId, $objectType, $objectId, $status, $checkCollectionId, $checkTemplateId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChecksApi->listExtChecks: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |
| **objectType** | **string**| Object type to be handled | [optional] |
| **objectId** | **string**| ID of the object, to be handled | [optional] |
| **status** | **string**| Status of the handle | [optional] |
| **checkCollectionId** | **float**| ID of check collection if started in scope of a collection | [optional] |
| **checkTemplateId** | **float**| Check Template for this check | [optional] |

### Return type

[**\Contabo\Generated\Model\ExtChecksListResponse**](../Model/ExtChecksListResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `startExtCheck()`

```php
startExtCheck($xRequestId, $baseCheckCreateRequest, $xTraceId): \Contabo\Generated\Model\ExtChecksGetResponse
```

Start check

Start a new check

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ChecksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$baseCheckCreateRequest = new \Contabo\Generated\Model\BaseCheckCreateRequest(); // \Contabo\Generated\Model\BaseCheckCreateRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->startExtCheck($xRequestId, $baseCheckCreateRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChecksApi->startExtCheck: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **baseCheckCreateRequest** | [**\Contabo\Generated\Model\BaseCheckCreateRequest**](../Model/BaseCheckCreateRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\ExtChecksGetResponse**](../Model/ExtChecksGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
