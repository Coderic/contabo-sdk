# Contabo\Generated\InternalCheckCollectionReplayApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**replayCheckCollection()**](InternalCheckCollectionReplayApi.md#replayCheckCollection) | **POST** /internal/v1/troubleshooting/check-collections/replays | Replay changes for Check |


## `replayCheckCollection()`

```php
replayCheckCollection($xRequestId, $checkCollectionsReplayRequest, $xTraceId): \Contabo\Generated\Model\ReplayResponse
```

Replay changes for Check

Replay changes for Check

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\InternalCheckCollectionReplayApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$checkCollectionsReplayRequest = new \Contabo\Generated\Model\CheckCollectionsReplayRequest(); // \Contabo\Generated\Model\CheckCollectionsReplayRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->replayCheckCollection($xRequestId, $checkCollectionsReplayRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalCheckCollectionReplayApi->replayCheckCollection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **checkCollectionsReplayRequest** | [**\Contabo\Generated\Model\CheckCollectionsReplayRequest**](../Model/CheckCollectionsReplayRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\ReplayResponse**](../Model/ReplayResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
