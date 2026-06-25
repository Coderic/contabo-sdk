# Contabo\Generated\ObjectStoragesApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelObjectStorage()**](ObjectStoragesApi.md#cancelObjectStorage) | **PATCH** /v1/object-storages/{objectStorageId}/cancel | Cancels the specified object storage at the next possible date |
| [**createObjectStorage()**](ObjectStoragesApi.md#createObjectStorage) | **POST** /v1/object-storages | Create a new object storage |
| [**retrieveDataCenterList()**](ObjectStoragesApi.md#retrieveDataCenterList) | **GET** /v1/data-centers | List data centers |
| [**retrieveObjectStorage()**](ObjectStoragesApi.md#retrieveObjectStorage) | **GET** /v1/object-storages/{objectStorageId} | Get specific object storage by its id |
| [**retrieveObjectStorageList()**](ObjectStoragesApi.md#retrieveObjectStorageList) | **GET** /v1/object-storages | List all your object storages |
| [**retrieveObjectStoragesStats()**](ObjectStoragesApi.md#retrieveObjectStoragesStats) | **GET** /v1/object-storages/{objectStorageId}/stats | List usage statistics about the specified object storage |
| [**updateObjectStorage()**](ObjectStoragesApi.md#updateObjectStorage) | **PATCH** /v1/object-storages/{objectStorageId} | Modifies the display name of object storage |
| [**upgradeObjectStorage()**](ObjectStoragesApi.md#upgradeObjectStorage) | **POST** /v1/object-storages/{objectStorageId}/resize | Upgrade object storage size resp. update autoscaling settings. |


## `cancelObjectStorage()`

```php
cancelObjectStorage($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId): \Contabo\Generated\Model\CancelObjectStorageResponse
```

Cancels the specified object storage at the next possible date

Cancels the specified object storage at the next possible date. Please be aware of your contract periods.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$objectStorageId = 4a6f95be-2ac0-4e3c-8eed-0dc67afed640; // string | The identifier of the object storage.
$cancelObjectStorageRequest = new \Contabo\Generated\Model\CancelObjectStorageRequest(); // \Contabo\Generated\Model\CancelObjectStorageRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->cancelObjectStorage($xRequestId, $objectStorageId, $cancelObjectStorageRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->cancelObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **objectStorageId** | **string**| The identifier of the object storage. | |
| **cancelObjectStorageRequest** | [**\Contabo\Generated\Model\CancelObjectStorageRequest**](../Model/CancelObjectStorageRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\CancelObjectStorageResponse**](../Model/CancelObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createObjectStorage()`

```php
createObjectStorage($xRequestId, $createObjectStorageRequest, $xTraceId): \Contabo\Generated\Model\CreateObjectStorageResponse
```

Create a new object storage

Create / purchase a new object storage in your account. Please note that you can only buy one object storage per location. You can actually increase the object storage space via `POST` to `/v1/object-storages/{objectStorageId}/resize`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$createObjectStorageRequest = new \Contabo\Generated\Model\CreateObjectStorageRequest(); // \Contabo\Generated\Model\CreateObjectStorageRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createObjectStorage($xRequestId, $createObjectStorageRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->createObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **createObjectStorageRequest** | [**\Contabo\Generated\Model\CreateObjectStorageRequest**](../Model/CreateObjectStorageRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\CreateObjectStorageResponse**](../Model/CreateObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveDataCenterList()`

```php
retrieveDataCenterList($xRequestId, $xTraceId, $page, $size, $orderBy, $slug, $name, $regionName, $regionSlug): \Contabo\Generated\Model\ListDataCenterResponse
```

List data centers

List all data centers and their corresponding regions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ObjectStoragesApi(
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
$slug = EU1; // string | Filter as match for data centers.
$name = European Union 1; // string | Filter for Object Storages regions.
$regionName = European Union; // string | Filter for Object Storage region names.
$regionSlug = EU; // string | Filter for Object Storage region slugs.

try {
    $result = $apiInstance->retrieveDataCenterList($xRequestId, $xTraceId, $page, $size, $orderBy, $slug, $name, $regionName, $regionSlug);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->retrieveDataCenterList: ', $e->getMessage(), PHP_EOL;
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
| **slug** | **string**| Filter as match for data centers. | [optional] |
| **name** | **string**| Filter for Object Storages regions. | [optional] |
| **regionName** | **string**| Filter for Object Storage region names. | [optional] |
| **regionSlug** | **string**| Filter for Object Storage region slugs. | [optional] |

### Return type

[**\Contabo\Generated\Model\ListDataCenterResponse**](../Model/ListDataCenterResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveObjectStorage()`

```php
retrieveObjectStorage($xRequestId, $objectStorageId, $xTraceId): \Contabo\Generated\Model\FindObjectStorageResponse
```

Get specific object storage by its id

Get data for a specific object storage on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$objectStorageId = 4a6f95be-2ac0-4e3c-8eed-0dc67afed640; // string | The identifier of the object storage.
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveObjectStorage($xRequestId, $objectStorageId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->retrieveObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **objectStorageId** | **string**| The identifier of the object storage. | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\FindObjectStorageResponse**](../Model/FindObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveObjectStorageList()`

```php
retrieveObjectStorageList($xRequestId, $xTraceId, $page, $size, $orderBy, $dataCenterName, $s3TenantId, $region, $displayName): \Contabo\Generated\Model\ListObjectStorageResponse
```

List all your object storages

List and filter all object storages in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ObjectStoragesApi(
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
$dataCenterName = European Union 2; // string | Filter for Object Storage locations.
$s3TenantId = 2cd2e5e1444a41b0bed16c6410ecaa84; // string | Filter for Object Storage S3 tenantId.
$region = EU; // string | Filter for Object Storage by regions. Available regions: EU, US-central, SIN
$displayName = MyObjectStorage; // string | Filter for Object Storage by display name.

try {
    $result = $apiInstance->retrieveObjectStorageList($xRequestId, $xTraceId, $page, $size, $orderBy, $dataCenterName, $s3TenantId, $region, $displayName);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->retrieveObjectStorageList: ', $e->getMessage(), PHP_EOL;
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
| **dataCenterName** | **string**| Filter for Object Storage locations. | [optional] |
| **s3TenantId** | **string**| Filter for Object Storage S3 tenantId. | [optional] |
| **region** | **string**| Filter for Object Storage by regions. Available regions: EU, US-central, SIN | [optional] |
| **displayName** | **string**| Filter for Object Storage by display name. | [optional] |

### Return type

[**\Contabo\Generated\Model\ListObjectStorageResponse**](../Model/ListObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveObjectStoragesStats()`

```php
retrieveObjectStoragesStats($xRequestId, $objectStorageId, $xTraceId): \Contabo\Generated\Model\ObjectStoragesStatsResponse
```

List usage statistics about the specified object storage

List usage statistics about the specified object storage such as the number of objects uploaded / created, used object storage space. Please note that the usage statistics are updated regularly and are not live usage statistics.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$objectStorageId = 4a6f95be-2ac0-4e3c-8eed-0dc67afed640; // string | The identifier of the object storage.
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveObjectStoragesStats($xRequestId, $objectStorageId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->retrieveObjectStoragesStats: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **objectStorageId** | **string**| The identifier of the object storage. | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\ObjectStoragesStatsResponse**](../Model/ObjectStoragesStatsResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateObjectStorage()`

```php
updateObjectStorage($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId): \Contabo\Generated\Model\CancelObjectStorageResponse
```

Modifies the display name of object storage

Modifies the display name of object storage. Display name must be unique.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$objectStorageId = 4a6f95be-2ac0-4e3c-8eed-0dc67afed640; // string | The identifier of the object storage.
$patchObjectStorageRequest = new \Contabo\Generated\Model\PatchObjectStorageRequest(); // \Contabo\Generated\Model\PatchObjectStorageRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->updateObjectStorage($xRequestId, $objectStorageId, $patchObjectStorageRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->updateObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **objectStorageId** | **string**| The identifier of the object storage. | |
| **patchObjectStorageRequest** | [**\Contabo\Generated\Model\PatchObjectStorageRequest**](../Model/PatchObjectStorageRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\CancelObjectStorageResponse**](../Model/CancelObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `upgradeObjectStorage()`

```php
upgradeObjectStorage($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId): \Contabo\Generated\Model\UpgradeObjectStorageResponse
```

Upgrade object storage size resp. update autoscaling settings.

Upgrade object storage size. You can also adjust the autoscaling settings for your object storage. Autoscaling allows you to automatically purchase storage capacity on a monthly basis up to the specified limit.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Contabo\Generated\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$objectStorageId = 4a6f95be-2ac0-4e3c-8eed-0dc67afed640; // string | The identifier of the object storage.
$upgradeObjectStorageRequest = new \Contabo\Generated\Model\UpgradeObjectStorageRequest(); // \Contabo\Generated\Model\UpgradeObjectStorageRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->upgradeObjectStorage($xRequestId, $objectStorageId, $upgradeObjectStorageRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->upgradeObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **objectStorageId** | **string**| The identifier of the object storage. | |
| **upgradeObjectStorageRequest** | [**\Contabo\Generated\Model\UpgradeObjectStorageRequest**](../Model/UpgradeObjectStorageRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Contabo\Generated\Model\UpgradeObjectStorageResponse**](../Model/UpgradeObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
