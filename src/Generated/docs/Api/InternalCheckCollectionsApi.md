# Coderic\Contabo\Generated\InternalCheckCollectionsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelCheckCollection()**](InternalCheckCollectionsApi.md#cancelCheckCollection) | **PATCH** /internal/v1/troubleshooting/check-collections/{orgId}/{checkCollectionId} | Cancel check collection |
| [**getCheckCollection()**](InternalCheckCollectionsApi.md#getCheckCollection) | **GET** /internal/v1/troubleshooting/check-collections/{orgId}/{checkCollectionId} | Get check collection |
| [**listCheckCollections()**](InternalCheckCollectionsApi.md#listCheckCollections) | **GET** /internal/v1/troubleshooting/check-collections | List check collections |
| [**startCheckCollection()**](InternalCheckCollectionsApi.md#startCheckCollection) | **POST** /internal/v1/troubleshooting/check-collections | Start check collection |


## `cancelCheckCollection()`

```php
cancelCheckCollection($xRequestId, $checkCollectionId, $orgId, $cancelRequest, $xTraceId): \Coderic\Contabo\Generated\Model\CheckCollectionsGetResponse
```

Cancel check collection

Cancel check collection

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalCheckCollectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkCollectionId = 12345; // float | Check collection's id
$orgId = cntb; // string | Org ID
$cancelRequest = new \Coderic\Contabo\Generated\Model\CancelRequest(); // \Coderic\Contabo\Generated\Model\CancelRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->cancelCheckCollection($xRequestId, $checkCollectionId, $orgId, $cancelRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalCheckCollectionsApi->cancelCheckCollection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkCollectionId** | **float**| Check collection&#39;s id | |
| **orgId** | **string**| Org ID | |
| **cancelRequest** | [**\Coderic\Contabo\Generated\Model\CancelRequest**](../Model/CancelRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\CheckCollectionsGetResponse**](../Model/CheckCollectionsGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCheckCollection()`

```php
getCheckCollection($xRequestId, $checkCollectionId, $orgId, $xTraceId): \Coderic\Contabo\Generated\Model\CheckCollectionsGetResponse
```

Get check collection

Get a single check collection by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalCheckCollectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkCollectionId = 12345; // float | Check collection's id
$orgId = cntb; // string | Org ID
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->getCheckCollection($xRequestId, $checkCollectionId, $orgId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalCheckCollectionsApi->getCheckCollection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkCollectionId** | **float**| Check collection&#39;s id | |
| **orgId** | **string**| Org ID | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\CheckCollectionsGetResponse**](../Model/CheckCollectionsGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCheckCollections()`

```php
listCheckCollections($xRequestId, $orgIds, $xTraceId, $objectType, $objectId, $checkCollectionTemplateId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $modificationStartTime, $modificationEndTime, $accountId): \Coderic\Contabo\Generated\Model\CheckCollectionsListResponse
```

List check collections

List and filter all check collections

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalCheckCollectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$orgIds = array('orgIds_example'); // string[] | Org IDs
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.
$objectType = vserver; // string | Object type to be handled
$objectId = 4711; // string | ID of the object, to be handled
$checkCollectionTemplateId = 12345; // float | Check Collection Template for this check collection
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$orderBy = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$creationStartTime = 2021-06-03T06:27:12Z; // \DateTime | Start of search time range for created date
$creationEndTime = 2021-06-03T10:27:12Z; // \DateTime | End of search time range for created date
$modificationStartTime = 2021-06-03T06:27:12Z; // \DateTime | Start of search time range for modified date
$modificationEndTime = 2021-06-03T10:27:12Z; // \DateTime | End of search time range for modified date
$accountId = DE-123; // string | Filter by account ID

try {
    $result = $apiInstance->listCheckCollections($xRequestId, $orgIds, $xTraceId, $objectType, $objectId, $checkCollectionTemplateId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $modificationStartTime, $modificationEndTime, $accountId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalCheckCollectionsApi->listCheckCollections: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **orgIds** | [**string[]**](../Model/string.md)| Org IDs | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |
| **objectType** | **string**| Object type to be handled | [optional] |
| **objectId** | **string**| ID of the object, to be handled | [optional] |
| **checkCollectionTemplateId** | **float**| Check Collection Template for this check collection | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **orderBy** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **creationStartTime** | **\DateTime**| Start of search time range for created date | [optional] |
| **creationEndTime** | **\DateTime**| End of search time range for created date | [optional] |
| **modificationStartTime** | **\DateTime**| Start of search time range for modified date | [optional] |
| **modificationEndTime** | **\DateTime**| End of search time range for modified date | [optional] |
| **accountId** | **string**| Filter by account ID | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\CheckCollectionsListResponse**](../Model/CheckCollectionsListResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `startCheckCollection()`

```php
startCheckCollection($xRequestId, $checkCollectionCreateRequest, $xTraceId): \Coderic\Contabo\Generated\Model\CheckCollectionsGetResponse
```

Start check collection

Start a new check collection

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalCheckCollectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkCollectionCreateRequest = new \Coderic\Contabo\Generated\Model\CheckCollectionCreateRequest(); // \Coderic\Contabo\Generated\Model\CheckCollectionCreateRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->startCheckCollection($xRequestId, $checkCollectionCreateRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalCheckCollectionsApi->startCheckCollection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkCollectionCreateRequest** | [**\Coderic\Contabo\Generated\Model\CheckCollectionCreateRequest**](../Model/CheckCollectionCreateRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\CheckCollectionsGetResponse**](../Model/CheckCollectionsGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
