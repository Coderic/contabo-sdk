# Coderic\Contabo\Generated\SnapshotsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createSnapshot()**](SnapshotsApi.md#createSnapshot) | **POST** /v1/compute/instances/{instanceId}/snapshots | Create a new instance snapshot |
| [**deleteSnapshot()**](SnapshotsApi.md#deleteSnapshot) | **DELETE** /v1/compute/instances/{instanceId}/snapshots/{snapshotId} | Delete existing snapshot by id |
| [**retrieveSnapshot()**](SnapshotsApi.md#retrieveSnapshot) | **GET** /v1/compute/instances/{instanceId}/snapshots/{snapshotId} | Retrieve a specific snapshot by id |
| [**retrieveSnapshotList()**](SnapshotsApi.md#retrieveSnapshotList) | **GET** /v1/compute/instances/{instanceId}/snapshots | List snapshots |
| [**rollbackSnapshot()**](SnapshotsApi.md#rollbackSnapshot) | **POST** /v1/compute/instances/{instanceId}/snapshots/{snapshotId}/rollback | Revert the instance to a particular snapshot based on its identifier |
| [**updateSnapshot()**](SnapshotsApi.md#updateSnapshot) | **PATCH** /v1/compute/instances/{instanceId}/snapshots/{snapshotId} | Update specific snapshot by id |


## `createSnapshot()`

```php
createSnapshot($xRequestId, $instanceId, $createSnapshotRequest, $xTraceId): \Coderic\Contabo\Generated\Model\CreateSnapshotResponse
```

Create a new instance snapshot

Create a new snapshot for instance, with name and description attributes

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$createSnapshotRequest = new \Coderic\Contabo\Generated\Model\CreateSnapshotRequest(); // \Coderic\Contabo\Generated\Model\CreateSnapshotRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createSnapshot($xRequestId, $instanceId, $createSnapshotRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->createSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **createSnapshotRequest** | [**\Coderic\Contabo\Generated\Model\CreateSnapshotRequest**](../Model/CreateSnapshotRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\CreateSnapshotResponse**](../Model/CreateSnapshotResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteSnapshot()`

```php
deleteSnapshot($xRequestId, $instanceId, $snapshotId, $xTraceId)
```

Delete existing snapshot by id

Delete existing instance snapshot by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$snapshotId = snap1628603855; // string | The identifier of the snapshot
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteSnapshot($xRequestId, $instanceId, $snapshotId, $xTraceId);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->deleteSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **snapshotId** | **string**| The identifier of the snapshot | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

void (empty response body)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveSnapshot()`

```php
retrieveSnapshot($xRequestId, $instanceId, $snapshotId, $xTraceId): \Coderic\Contabo\Generated\Model\FindSnapshotResponse
```

Retrieve a specific snapshot by id

Get all attributes for a specific snapshot

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$snapshotId = snap1628603855; // string | The identifier of the snapshot
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveSnapshot($xRequestId, $instanceId, $snapshotId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->retrieveSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **snapshotId** | **string**| The identifier of the snapshot | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\FindSnapshotResponse**](../Model/FindSnapshotResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveSnapshotList()`

```php
retrieveSnapshotList($xRequestId, $instanceId, $xTraceId, $page, $size, $orderBy, $name): \Coderic\Contabo\Generated\Model\ListSnapshotResponse
```

List snapshots

List and filter all your snapshots for a specific instance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$orderBy = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$name = Snapshot.Server; // string | Filter as substring match for snapshots names.

try {
    $result = $apiInstance->retrieveSnapshotList($xRequestId, $instanceId, $xTraceId, $page, $size, $orderBy, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->retrieveSnapshotList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **orderBy** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **name** | **string**| Filter as substring match for snapshots names. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ListSnapshotResponse**](../Model/ListSnapshotResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `rollbackSnapshot()`

```php
rollbackSnapshot($xRequestId, $instanceId, $snapshotId, $body, $xTraceId): \Coderic\Contabo\Generated\Model\RollbackSnapshotResponse
```

Revert the instance to a particular snapshot based on its identifier

Rollback the instance to a specific snapshot. In case the snapshot is not the latest one, it will automatically delete all the newer snapshots of the instance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$snapshotId = snap1628603855; // string | The identifier of the snapshot
$body = array('key' => new \stdClass); // object
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->rollbackSnapshot($xRequestId, $instanceId, $snapshotId, $body, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->rollbackSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **snapshotId** | **string**| The identifier of the snapshot | |
| **body** | **object**|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\RollbackSnapshotResponse**](../Model/RollbackSnapshotResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateSnapshot()`

```php
updateSnapshot($xRequestId, $instanceId, $snapshotId, $updateSnapshotRequest, $xTraceId): \Coderic\Contabo\Generated\Model\UpdateSnapshotResponse
```

Update specific snapshot by id

Update attributes of a snapshot. You may only specify the attributes you want to change. If an attribute is not set, it will retain its original value.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instanceId = 12345; // int | The identifier of the instance
$snapshotId = snap1628603855; // string | The identifier of the snapshot
$updateSnapshotRequest = new \Coderic\Contabo\Generated\Model\UpdateSnapshotRequest(); // \Coderic\Contabo\Generated\Model\UpdateSnapshotRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->updateSnapshot($xRequestId, $instanceId, $snapshotId, $updateSnapshotRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->updateSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instanceId** | **int**| The identifier of the instance | |
| **snapshotId** | **string**| The identifier of the snapshot | |
| **updateSnapshotRequest** | [**\Coderic\Contabo\Generated\Model\UpdateSnapshotRequest**](../Model/UpdateSnapshotRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\UpdateSnapshotResponse**](../Model/UpdateSnapshotResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
