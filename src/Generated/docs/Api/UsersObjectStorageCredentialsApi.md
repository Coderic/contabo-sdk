# Coderic\Contabo\Generated\UsersObjectStorageCredentialsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getObjectStorageCredentials()**](UsersObjectStorageCredentialsApi.md#getObjectStorageCredentials) | **GET** /v1/users/{userId}/object-storages/{objectStorageId}/credentials/{credentialId} | Get S3 compatible object storage credentials. |
| [**listObjectStorageCredentials()**](UsersObjectStorageCredentialsApi.md#listObjectStorageCredentials) | **GET** /v1/users/{userId}/object-storages/credentials | Get list of S3 compatible object storage credentials for user. |
| [**regenerateObjectStorageCredentials()**](UsersObjectStorageCredentialsApi.md#regenerateObjectStorageCredentials) | **PATCH** /v1/users/{userId}/object-storages/{objectStorageId}/credentials/{credentialId} | Regenerates secret key of specified user for the S3 compatible object storages. |


## `getObjectStorageCredentials()`

```php
getObjectStorageCredentials($xRequestId, $userId, $objectStorageId, $credentialId, $xTraceId): \Coderic\Contabo\Generated\Model\FindCredentialResponse
```

Get S3 compatible object storage credentials.

Get S3 compatible object storage credentials for accessing it via S3 compatible tools like `aws` cli.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\UsersObjectStorageCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$userId = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user.
$objectStorageId = d8417276-d2d9-43a9-a0a8-9a6fa6060246; // string | The identifier of the S3 object storage
$credentialId = 12345; // int | The ID of the object storage credential
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->getObjectStorageCredentials($xRequestId, $userId, $objectStorageId, $credentialId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersObjectStorageCredentialsApi->getObjectStorageCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **userId** | **string**| The identifier of the user. | |
| **objectStorageId** | **string**| The identifier of the S3 object storage | |
| **credentialId** | **int**| The ID of the object storage credential | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\FindCredentialResponse**](../Model/FindCredentialResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listObjectStorageCredentials()`

```php
listObjectStorageCredentials($xRequestId, $userId, $xTraceId, $page, $size, $orderBy, $objectStorageId, $regionName, $displayName): \Coderic\Contabo\Generated\Model\ListCredentialResponse
```

Get list of S3 compatible object storage credentials for user.

Get list of S3 compatible object storage credentials for accessing it via S3 compatible tools like `aws` cli.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\UsersObjectStorageCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$userId = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user.
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$orderBy = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$objectStorageId = d8417276-d2d9-43a9-a0a8-9a6fa6060246; // string | The identifier of the S3 object storage
$regionName = Asia (Singapore); // string | Filter for Object Storage by regions. Available regions: Asia (Singapore), European Union, United States (Central)
$displayName = Object Storage EU 420; // string | Filter for Object Storage by his displayName.

try {
    $result = $apiInstance->listObjectStorageCredentials($xRequestId, $userId, $xTraceId, $page, $size, $orderBy, $objectStorageId, $regionName, $displayName);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersObjectStorageCredentialsApi->listObjectStorageCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **userId** | **string**| The identifier of the user. | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **orderBy** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **objectStorageId** | **string**| The identifier of the S3 object storage | [optional] |
| **regionName** | **string**| Filter for Object Storage by regions. Available regions: Asia (Singapore), European Union, United States (Central) | [optional] |
| **displayName** | **string**| Filter for Object Storage by his displayName. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ListCredentialResponse**](../Model/ListCredentialResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `regenerateObjectStorageCredentials()`

```php
regenerateObjectStorageCredentials($xRequestId, $userId, $objectStorageId, $credentialId, $xTraceId): \Coderic\Contabo\Generated\Model\FindCredentialResponse
```

Regenerates secret key of specified user for the S3 compatible object storages.

Regenerates secret key of specified user for the a specific S3 compatible object storages.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\UsersObjectStorageCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$userId = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user.
$objectStorageId = d8417276-d2d9-43a9-a0a8-9a6fa6060246; // string | The identifier of the S3 object storage
$credentialId = 12345; // int | The ID of the object storage credential
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->regenerateObjectStorageCredentials($xRequestId, $userId, $objectStorageId, $credentialId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersObjectStorageCredentialsApi->regenerateObjectStorageCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **userId** | **string**| The identifier of the user. | |
| **objectStorageId** | **string**| The identifier of the S3 object storage | |
| **credentialId** | **int**| The ID of the object storage credential | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\FindCredentialResponse**](../Model/FindCredentialResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
