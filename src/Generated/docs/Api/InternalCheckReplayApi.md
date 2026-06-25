# Coderic\Contabo\Generated\InternalCheckReplayApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**replayCheck()**](InternalCheckReplayApi.md#replayCheck) | **POST** /internal/v1/troubleshooting/checks/replays | Replay changes for Check |


## `replayCheck()`

```php
replayCheck($xRequestId, $checksReplayRequest, $xTraceId): \Coderic\Contabo\Generated\Model\ReplayResponse
```

Replay changes for Check

Replay changes for Check

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\InternalCheckReplayApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checksReplayRequest = new \Coderic\Contabo\Generated\Model\ChecksReplayRequest(); // \Coderic\Contabo\Generated\Model\ChecksReplayRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->replayCheck($xRequestId, $checksReplayRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalCheckReplayApi->replayCheck: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checksReplayRequest** | [**\Coderic\Contabo\Generated\Model\ChecksReplayRequest**](../Model/ChecksReplayRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ReplayResponse**](../Model/ReplayResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
