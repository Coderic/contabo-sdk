# Coderic\Contabo\Generated\InternalRemedyTemplatesApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getRemedyTemplate()**](InternalRemedyTemplatesApi.md#getRemedyTemplate) | **GET** /internal/v1/troubleshooting/remedy-templates/{orgId}/{remedyTemplateId} | Get remedy |
| [**listRemedyTemplates()**](InternalRemedyTemplatesApi.md#listRemedyTemplates) | **GET** /internal/v1/troubleshooting/remedy-templates | List remedy templates |


## `getRemedyTemplate()`

```php
getRemedyTemplate($xRequestId, $orgId, $remedyTemplateId, $xTraceId): \Coderic\Contabo\Generated\Model\RemedyTemplatesGetResponse
```

Get remedy

Get a single remedy template by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalRemedyTemplatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$orgId = cntb; // string | Org ID
$remedyTemplateId = 12345; // float | Remedy template's id
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->getRemedyTemplate($xRequestId, $orgId, $remedyTemplateId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalRemedyTemplatesApi->getRemedyTemplate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **orgId** | **string**| Org ID | |
| **remedyTemplateId** | **float**| Remedy template&#39;s id | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\RemedyTemplatesGetResponse**](../Model/RemedyTemplatesGetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listRemedyTemplates()`

```php
listRemedyTemplates($xRequestId, $orgIds, $xTraceId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $modificationStartTime, $modificationEndTime, $accountId, $internal, $objectType, $collectorClass, $remedyClass): \Coderic\Contabo\Generated\Model\RemedyTemplatesListResponse
```

List remedy templates

List and filter all remedy templates

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalRemedyTemplatesApi(
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
$internal = false; // bool | Is remedy only internal (not shown to the customer)
$objectType = vserver; // string | Object type for which the remedy template can be used
$collectorClass = InstanceCollector.ts; // string | Class used to collect the required information for the remedy
$remedyClass = PingRemedy.ts; // string | Class used to perform the remedy

try {
    $result = $apiInstance->listRemedyTemplates($xRequestId, $orgIds, $xTraceId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $modificationStartTime, $modificationEndTime, $accountId, $internal, $objectType, $collectorClass, $remedyClass);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalRemedyTemplatesApi->listRemedyTemplates: ', $e->getMessage(), PHP_EOL;
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
| **internal** | **bool**| Is remedy only internal (not shown to the customer) | [optional] |
| **objectType** | **string**| Object type for which the remedy template can be used | [optional] |
| **collectorClass** | **string**| Class used to collect the required information for the remedy | [optional] |
| **remedyClass** | **string**| Class used to perform the remedy | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\RemedyTemplatesListResponse**](../Model/RemedyTemplatesListResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
