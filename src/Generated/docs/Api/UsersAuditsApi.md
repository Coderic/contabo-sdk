# Contabo\Generated\UsersAuditsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**retrieveUserAuditsList()**](UsersAuditsApi.md#retrieveUserAuditsList) | **GET** /v1/users/audits | List history about your users (audit) |


## `retrieveUserAuditsList()`

```php
retrieveUserAuditsList($xRequestId, $xTraceId, $page, $size, $orderBy, $userId, $requestId, $changedBy, $startDate, $endDate): \Contabo\Generated\Model\ListUserAuditResponse
```

List history about your users (audit)

List and filter the history about your users.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\UsersAuditsApi(
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
$userId = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user.
$requestId = D5FD9FAF-58C0-4406-8F46-F449B8E4FEC3; // string | The requestId of the API call which led to the change.
$changedBy = 23cbb6d6-cb11-4330-bdff-7bb791df2e23; // string | changedBy of the user which led to the change.
$startDate = Thu Dec 31 19:00:00 GMT-05:00 2020; // \DateTime | Start of search time range.
$endDate = Thu Dec 31 19:00:00 GMT-05:00 2020; // \DateTime | End of search time range.

try {
    $result = $apiInstance->retrieveUserAuditsList($xRequestId, $xTraceId, $page, $size, $orderBy, $userId, $requestId, $changedBy, $startDate, $endDate);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersAuditsApi->retrieveUserAuditsList: ', $e->getMessage(), PHP_EOL;
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
| **userId** | **string**| The identifier of the user. | [optional] |
| **requestId** | **string**| The requestId of the API call which led to the change. | [optional] |
| **changedBy** | **string**| changedBy of the user which led to the change. | [optional] |
| **startDate** | **\DateTime**| Start of search time range. | [optional] |
| **endDate** | **\DateTime**| End of search time range. | [optional] |

### Return type

[**\Contabo\Generated\Model\ListUserAuditResponse**](../Model/ListUserAuditResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
