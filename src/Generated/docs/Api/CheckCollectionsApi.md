# Coderic\Contabo\Generated\CheckCollectionsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelExtCheckCollection()**](CheckCollectionsApi.md#cancelExtCheckCollection) | **PATCH** /v1/troubleshooting/check-collections/{checkCollectionId} | Cancel check collection |
| [**getExtCheckCollection()**](CheckCollectionsApi.md#getExtCheckCollection) | **GET** /v1/troubleshooting/check-collections/{checkCollectionId} | Get check collection |
| [**listExtCheckCollections()**](CheckCollectionsApi.md#listExtCheckCollections) | **GET** /v1/troubleshooting/check-collections | List check collections |
| [**startExtCheckCollection()**](CheckCollectionsApi.md#startExtCheckCollection) | **POST** /v1/troubleshooting/check-collections | Start check collection |


## `cancelExtCheckCollection()`

```php
cancelExtCheckCollection($xRequestId, $checkCollectionId, $cancelRequest, $xTraceId): \Coderic\Contabo\Generated\Model\ExtCheckCollectionsGetResponse
```

Cancel check collection

Cancel check collection

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\CheckCollectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkCollectionId = 12345; // float | Check collection's id
$cancelRequest = new \Coderic\Contabo\Generated\Model\CancelRequest(); // \Coderic\Contabo\Generated\Model\CancelRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->cancelExtCheckCollection($xRequestId, $checkCollectionId, $cancelRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckCollectionsApi->cancelExtCheckCollection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkCollectionId** | **float**| Check collection&#39;s id | |
| **cancelRequest** | [**\Coderic\Contabo\Generated\Model\CancelRequest**](../Model/CancelRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ExtCheckCollectionsGetResponse**](../Model/ExtCheckCollectionsGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getExtCheckCollection()`

```php
getExtCheckCollection($xRequestId, $checkCollectionId, $xTraceId): \Coderic\Contabo\Generated\Model\ExtCheckCollectionsGetResponse
```

Get check collection

Get a single check collection by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\CheckCollectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkCollectionId = 12345; // float | Check collection's id
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->getExtCheckCollection($xRequestId, $checkCollectionId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckCollectionsApi->getExtCheckCollection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkCollectionId** | **float**| Check collection&#39;s id | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ExtCheckCollectionsGetResponse**](../Model/ExtCheckCollectionsGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listExtCheckCollections()`

```php
listExtCheckCollections($xRequestId, $xTraceId, $objectType, $objectId, $checkCollectionTemplateId): \Coderic\Contabo\Generated\Model\ExtCheckCollectionsListResponse
```

List check collections

List and filter all check collections

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\CheckCollectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.
$objectType = vserver; // string | Object type to be handled
$objectId = 4711; // string | ID of the object, to be handled
$checkCollectionTemplateId = 12345; // float | Check Collection Template for this check collection

try {
    $result = $apiInstance->listExtCheckCollections($xRequestId, $xTraceId, $objectType, $objectId, $checkCollectionTemplateId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckCollectionsApi->listExtCheckCollections: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |
| **objectType** | **string**| Object type to be handled | [optional] |
| **objectId** | **string**| ID of the object, to be handled | [optional] |
| **checkCollectionTemplateId** | **float**| Check Collection Template for this check collection | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ExtCheckCollectionsListResponse**](../Model/ExtCheckCollectionsListResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `startExtCheckCollection()`

```php
startExtCheckCollection($xRequestId, $baseCheckCollectionCreateRequest, $xTraceId): \Coderic\Contabo\Generated\Model\ExtCheckCollectionsGetResponse
```

Start check collection

Start a new check collection

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\CheckCollectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$baseCheckCollectionCreateRequest = new \Coderic\Contabo\Generated\Model\BaseCheckCollectionCreateRequest(); // \Coderic\Contabo\Generated\Model\BaseCheckCollectionCreateRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->startExtCheckCollection($xRequestId, $baseCheckCollectionCreateRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckCollectionsApi->startExtCheckCollection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **baseCheckCollectionCreateRequest** | [**\Coderic\Contabo\Generated\Model\BaseCheckCollectionCreateRequest**](../Model/BaseCheckCollectionCreateRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ExtCheckCollectionsGetResponse**](../Model/ExtCheckCollectionsGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
