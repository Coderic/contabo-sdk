# Coderic\Contabo\Generated\InternalCheckCollectionTemplatesApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getCheckCollectionTemplate()**](InternalCheckCollectionTemplatesApi.md#getCheckCollectionTemplate) | **GET** /internal/v1/troubleshooting/check-collection-templates/{orgId}/{checkCollectionTemplateId} | Get check |
| [**listCheckCollectionTemplates()**](InternalCheckCollectionTemplatesApi.md#listCheckCollectionTemplates) | **GET** /internal/v1/troubleshooting/check-collection-templates | List check collection templates |


## `getCheckCollectionTemplate()`

```php
getCheckCollectionTemplate($xRequestId, $orgId, $checkCollectionTemplateId, $xTraceId): \Coderic\Contabo\Generated\Model\CheckCollectionTemplatesGetResponse
```

Get check

Get a single check collection template by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalCheckCollectionTemplatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$orgId = cntb; // string | Org ID
$checkCollectionTemplateId = 12345; // float | Check collection template's id
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->getCheckCollectionTemplate($xRequestId, $orgId, $checkCollectionTemplateId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalCheckCollectionTemplatesApi->getCheckCollectionTemplate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **orgId** | **string**| Org ID | |
| **checkCollectionTemplateId** | **float**| Check collection template&#39;s id | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\CheckCollectionTemplatesGetResponse**](../Model/CheckCollectionTemplatesGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCheckCollectionTemplates()`

```php
listCheckCollectionTemplates($xRequestId, $orgIds, $xTraceId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $modificationStartTime, $modificationEndTime, $accountId, $internal, $objectType): \Coderic\Contabo\Generated\Model\CheckCollectionTemplatesListResponse
```

List check collection templates

List and filter all check collection templates

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalCheckCollectionTemplatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$orgIds = array('orgIds_example'); // string[] | Org IDs
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$orderBy = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$creationStartTime = 2021-06-03T06:27:12Z; // \DateTime | Start of search time range for created date
$creationEndTime = 2021-06-03T10:27:12Z; // \DateTime | End of search time range for created date
$modificationStartTime = 2021-06-03T06:27:12Z; // \DateTime | Start of search time range for modified date
$modificationEndTime = 2021-06-03T10:27:12Z; // \DateTime | End of search time range for modified date
$accountId = DE-123; // string | Filter by account ID
$internal = false; // bool | Is check only internal (not shown to the customer)
$objectType = vserver; // string | Object type for which the check template can be used

try {
    $result = $apiInstance->listCheckCollectionTemplates($xRequestId, $orgIds, $xTraceId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $modificationStartTime, $modificationEndTime, $accountId, $internal, $objectType);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalCheckCollectionTemplatesApi->listCheckCollectionTemplates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **orgIds** | [**string[]**](../Model/string.md)| Org IDs | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **orderBy** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **creationStartTime** | **\DateTime**| Start of search time range for created date | [optional] |
| **creationEndTime** | **\DateTime**| End of search time range for created date | [optional] |
| **modificationStartTime** | **\DateTime**| Start of search time range for modified date | [optional] |
| **modificationEndTime** | **\DateTime**| End of search time range for modified date | [optional] |
| **accountId** | **string**| Filter by account ID | [optional] |
| **internal** | **bool**| Is check only internal (not shown to the customer) | [optional] |
| **objectType** | **string**| Object type for which the check template can be used | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\CheckCollectionTemplatesListResponse**](../Model/CheckCollectionTemplatesListResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
