# Contabo\Generated\InternalChecksApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelCheck()**](InternalChecksApi.md#cancelCheck) | **PATCH** /internal/v1/troubleshooting/checks/{orgId}/{checkId} | Cancel check |
| [**getCheck()**](InternalChecksApi.md#getCheck) | **GET** /internal/v1/troubleshooting/checks/{orgId}/{checkId} | Get check |
| [**listChecks()**](InternalChecksApi.md#listChecks) | **GET** /internal/v1/troubleshooting/checks | List check |
| [**startCheck()**](InternalChecksApi.md#startCheck) | **POST** /internal/v1/troubleshooting/checks | Start check |


## `cancelCheck()`

```php
cancelCheck($xRequestId, $checkId, $orgId, $cancelRequest, $xTraceId): \Contabo\Generated\Model\ChecksGetResponse
```

Cancel check

Cancel check

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InternalChecksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkId = 12345; // float | Check's id
$orgId = cntb; // string | Org ID
$cancelRequest = new \Contabo\Generated\Model\CancelRequest(); // \Contabo\Generated\Model\CancelRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->cancelCheck($xRequestId, $checkId, $orgId, $cancelRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalChecksApi->cancelCheck: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkId** | **float**| Check&#39;s id | |
| **orgId** | **string**| Org ID | |
| **cancelRequest** | [**\Contabo\Generated\Model\CancelRequest**](../Model/CancelRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\ChecksGetResponse**](../Model/ChecksGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCheck()`

```php
getCheck($xRequestId, $checkId, $orgId, $xTraceId): \Contabo\Generated\Model\ChecksGetResponse
```

Get check

Get a single check by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InternalChecksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkId = 12345; // float | Check's id
$orgId = cntb; // string | Org ID
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->getCheck($xRequestId, $checkId, $orgId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalChecksApi->getCheck: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkId** | **float**| Check&#39;s id | |
| **orgId** | **string**| Org ID | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\ChecksGetResponse**](../Model/ChecksGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listChecks()`

```php
listChecks($xRequestId, $orgIds, $xTraceId, $objectType, $objectId, $status, $checkCollectionId, $checkTemplateId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $modificationStartTime, $modificationEndTime, $accountId): \Contabo\Generated\Model\ChecksListResponse
```

List check

List and filter all checks

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InternalChecksApi(
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
$status = failed; // string | Status of the handle
$checkCollectionId = 12345; // float | ID of check collection if started in scope of a collection
$checkTemplateId = 12345; // float | Check Template for this check
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$orderBy = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$creationStartTime = 2021-06-03T06:27:12Z; // \DateTime | Start of search time range for created date
$creationEndTime = 2021-06-03T10:27:12Z; // \DateTime | End of search time range for created date
$modificationStartTime = 2021-06-03T06:27:12Z; // \DateTime | Start of search time range for modified date
$modificationEndTime = 2021-06-03T10:27:12Z; // \DateTime | End of search time range for modified date
$accountId = DE-123; // string | Filter by account ID

try {
    $result = $apiInstance->listChecks($xRequestId, $orgIds, $xTraceId, $objectType, $objectId, $status, $checkCollectionId, $checkTemplateId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $modificationStartTime, $modificationEndTime, $accountId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalChecksApi->listChecks: ', $e->getMessage(), PHP_EOL;
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
| **status** | **string**| Status of the handle | [optional] |
| **checkCollectionId** | **float**| ID of check collection if started in scope of a collection | [optional] |
| **checkTemplateId** | **float**| Check Template for this check | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **orderBy** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **creationStartTime** | **\DateTime**| Start of search time range for created date | [optional] |
| **creationEndTime** | **\DateTime**| End of search time range for created date | [optional] |
| **modificationStartTime** | **\DateTime**| Start of search time range for modified date | [optional] |
| **modificationEndTime** | **\DateTime**| End of search time range for modified date | [optional] |
| **accountId** | **string**| Filter by account ID | [optional] |

### Return type

[**\Contabo\Generated\Model\ChecksListResponse**](../Model/ChecksListResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `startCheck()`

```php
startCheck($xRequestId, $checkCreateRequest, $xTraceId): \Contabo\Generated\Model\ChecksGetResponse
```

Start check

Start a new check

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InternalChecksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkCreateRequest = new \Contabo\Generated\Model\CheckCreateRequest(); // \Contabo\Generated\Model\CheckCreateRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->startCheck($xRequestId, $checkCreateRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalChecksApi->startCheck: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkCreateRequest** | [**\Contabo\Generated\Model\CheckCreateRequest**](../Model/CheckCreateRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\ChecksGetResponse**](../Model/ChecksGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
