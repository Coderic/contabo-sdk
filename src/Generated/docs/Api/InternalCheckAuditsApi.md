# Coderic\Contabo\Generated\InternalCheckAuditsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**retrieveChecksAuditsList()**](InternalCheckAuditsApi.md#retrieveChecksAuditsList) | **GET** /internal/v1/troubleshooting/checks/audits | List history about your Data (audit) |


## `retrieveChecksAuditsList()`

```php
retrieveChecksAuditsList($xRequestId, $orgIds, $xTraceId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $accountId, $requestId, $foreignChangedBy, $changedBy, $checkId): \Coderic\Contabo\Generated\Model\ChecksAuditListResponse
```

List history about your Data (audit)

List and filters the history about your Data.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalCheckAuditsApi(
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
$accountId = DE-123; // string | Filter by account ID
$requestId = D5FD9FAF-58C0-4406-8F46-F449B8E4FEC3; // string | The requestId of the API call which led to the change.
$foreignChangedBy = 23cbb6d6-cb11-4330-bdff-7bb791df2e23; // string | Foreign uerId of the user which led to the change.
$changedBy = 23cbb6d6-cb11-4330-bdff-7bb791df2e23; // string | UserId of the user which led to the change.
$checkId = 12345; // float | Check's id

try {
    $result = $apiInstance->retrieveChecksAuditsList($xRequestId, $orgIds, $xTraceId, $page, $size, $orderBy, $creationStartTime, $creationEndTime, $accountId, $requestId, $foreignChangedBy, $changedBy, $checkId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalCheckAuditsApi->retrieveChecksAuditsList: ', $e->getMessage(), PHP_EOL;
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
| **accountId** | **string**| Filter by account ID | [optional] |
| **requestId** | **string**| The requestId of the API call which led to the change. | [optional] |
| **foreignChangedBy** | **string**| Foreign uerId of the user which led to the change. | [optional] |
| **changedBy** | **string**| UserId of the user which led to the change. | [optional] |
| **checkId** | **float**| Check&#39;s id | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ChecksAuditListResponse**](../Model/ChecksAuditListResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
