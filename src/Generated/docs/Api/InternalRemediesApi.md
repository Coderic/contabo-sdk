# Coderic\Contabo\Generated\InternalRemediesApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelRemedy()**](InternalRemediesApi.md#cancelRemedy) | **PATCH** /internal/v1/troubleshooting/remedies/{orgId}/{remedyId} | Cancel remedy |
| [**getRemedy()**](InternalRemediesApi.md#getRemedy) | **GET** /internal/v1/troubleshooting/remedies/{orgId}/{remedyId} | Get remedy |
| [**listRemedies()**](InternalRemediesApi.md#listRemedies) | **GET** /internal/v1/troubleshooting/remedies | List remedy |
| [**startRemedy()**](InternalRemediesApi.md#startRemedy) | **POST** /internal/v1/troubleshooting/remedies | Start remedy |


## `cancelRemedy()`

```php
cancelRemedy($xRequestId, $remedyId, $orgId, $cancelRequest, $xTraceId): \Coderic\Contabo\Generated\Model\RemediesGetResponse
```

Cancel remedy

Cancel remedy

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalRemediesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$remedyId = 12345; // float | Remedy's id
$orgId = cntb; // string | Org ID
$cancelRequest = new \Coderic\Contabo\Generated\Model\CancelRequest(); // \Coderic\Contabo\Generated\Model\CancelRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->cancelRemedy($xRequestId, $remedyId, $orgId, $cancelRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalRemediesApi->cancelRemedy: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **remedyId** | **float**| Remedy&#39;s id | |
| **orgId** | **string**| Org ID | |
| **cancelRequest** | [**\Coderic\Contabo\Generated\Model\CancelRequest**](../Model/CancelRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\RemediesGetResponse**](../Model/RemediesGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getRemedy()`

```php
getRemedy($xRequestId, $remedyId, $orgId, $xTraceId): \Coderic\Contabo\Generated\Model\RemediesGetResponse
```

Get remedy

Get a single remedy by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalRemediesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$remedyId = 12345; // float | Remedy's id
$orgId = cntb; // string | Org ID
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->getRemedy($xRequestId, $remedyId, $orgId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalRemediesApi->getRemedy: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **remedyId** | **float**| Remedy&#39;s id | |
| **orgId** | **string**| Org ID | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\RemediesGetResponse**](../Model/RemediesGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listRemedies()`

```php
listRemedies($xRequestId, $orgIds, $xTraceId, $objectType, $objectId, $status, $remedyCollectionId, $remedyTemplateId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $modificationStartTime, $modificationEndTime, $accountId): \Coderic\Contabo\Generated\Model\RemediesListResponse
```

List remedy

List and filter all remedies

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalRemediesApi(
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
$remedyCollectionId = 12345; // float | ID of remedy collection if started in scope of a collection
$remedyTemplateId = 12345; // float | Remedy Template for this check
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$orderBy = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$creationStartTime = 2021-06-03T06:27:12Z; // \DateTime | Start of search time range for created date
$creationEndTime = 2021-06-03T10:27:12Z; // \DateTime | End of search time range for created date
$modificationStartTime = 2021-06-03T06:27:12Z; // \DateTime | Start of search time range for modified date
$modificationEndTime = 2021-06-03T10:27:12Z; // \DateTime | End of search time range for modified date
$accountId = DE-123; // string | Filter by account ID

try {
    $result = $apiInstance->listRemedies($xRequestId, $orgIds, $xTraceId, $objectType, $objectId, $status, $remedyCollectionId, $remedyTemplateId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $modificationStartTime, $modificationEndTime, $accountId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalRemediesApi->listRemedies: ', $e->getMessage(), PHP_EOL;
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
| **remedyCollectionId** | **float**| ID of remedy collection if started in scope of a collection | [optional] |
| **remedyTemplateId** | **float**| Remedy Template for this check | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **orderBy** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **creationStartTime** | **\DateTime**| Start of search time range for created date | [optional] |
| **creationEndTime** | **\DateTime**| End of search time range for created date | [optional] |
| **modificationStartTime** | **\DateTime**| Start of search time range for modified date | [optional] |
| **modificationEndTime** | **\DateTime**| End of search time range for modified date | [optional] |
| **accountId** | **string**| Filter by account ID | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\RemediesListResponse**](../Model/RemediesListResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `startRemedy()`

```php
startRemedy($xRequestId, $remediesCreateRequest, $xTraceId): \Coderic\Contabo\Generated\Model\RemediesGetResponse
```

Start remedy

Start a new remedy

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalRemediesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$remediesCreateRequest = new \Coderic\Contabo\Generated\Model\RemediesCreateRequest(); // \Coderic\Contabo\Generated\Model\RemediesCreateRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->startRemedy($xRequestId, $remediesCreateRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalRemediesApi->startRemedy: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **remediesCreateRequest** | [**\Coderic\Contabo\Generated\Model\RemediesCreateRequest**](../Model/RemediesCreateRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\RemediesGetResponse**](../Model/RemediesGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
