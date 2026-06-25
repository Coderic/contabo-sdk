# Coderic\Contabo\Generated\TagsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createTag()**](TagsApi.md#createTag) | **POST** /v1/tags | Create a new tag |
| [**deleteTag()**](TagsApi.md#deleteTag) | **DELETE** /v1/tags/{tagId} | Delete existing tag by id |
| [**retrieveTag()**](TagsApi.md#retrieveTag) | **GET** /v1/tags/{tagId} | Get specific tag by id |
| [**retrieveTagList()**](TagsApi.md#retrieveTagList) | **GET** /v1/tags | List tags |
| [**updateTag()**](TagsApi.md#updateTag) | **PATCH** /v1/tags/{tagId} | Update specific tag by id |


## `createTag()`

```php
createTag($xRequestId, $createTagRequest, $xTraceId): \Coderic\Contabo\Generated\Model\CreateTagResponse
```

Create a new tag

Create a new tag in your account with attribute name and optional attribute color.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$createTagRequest = new \Coderic\Contabo\Generated\Model\CreateTagRequest(); // \Coderic\Contabo\Generated\Model\CreateTagRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createTag($xRequestId, $createTagRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->createTag: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **createTagRequest** | [**\Coderic\Contabo\Generated\Model\CreateTagRequest**](../Model/CreateTagRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\CreateTagResponse**](../Model/CreateTagResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteTag()`

```php
deleteTag($xRequestId, $tagId, $xTraceId)
```

Delete existing tag by id

Your tag can be deleted if it is not assigned to any resource on your account. Check tag assigments before deleting tag.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$tagId = 12345; // int | The identifier of the tag
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteTag($xRequestId, $tagId, $xTraceId);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->deleteTag: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **tagId** | **int**| The identifier of the tag | |
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

## `retrieveTag()`

```php
retrieveTag($xRequestId, $tagId, $xTraceId): \Coderic\Contabo\Generated\Model\FindTagResponse
```

Get specific tag by id

Get attributes values to a specific tag on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$tagId = 12345; // int | The identifier of the tag
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveTag($xRequestId, $tagId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->retrieveTag: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **tagId** | **int**| The identifier of the tag | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\FindTagResponse**](../Model/FindTagResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveTagList()`

```php
retrieveTagList($xRequestId, $xTraceId, $page, $size, $orderBy, $name): \Coderic\Contabo\Generated\Model\ListTagResponse
```

List tags

List and filter all tags in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\TagsApi(
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
$name = web; // string | Filter as substring match for tag names. Tags may contain letters, numbers, colons, dashes, and underscores. There is a limit of 255 characters per tag.

try {
    $result = $apiInstance->retrieveTagList($xRequestId, $xTraceId, $page, $size, $orderBy, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->retrieveTagList: ', $e->getMessage(), PHP_EOL;
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
| **name** | **string**| Filter as substring match for tag names. Tags may contain letters, numbers, colons, dashes, and underscores. There is a limit of 255 characters per tag. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ListTagResponse**](../Model/ListTagResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateTag()`

```php
updateTag($xRequestId, $tagId, $updateTagRequest, $xTraceId): \Coderic\Contabo\Generated\Model\UpdateTagResponse
```

Update specific tag by id

Update attributes to your tag. Attributes are optional. If not set, the attributes will retain their original values.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$tagId = 12345; // int | The identifier of the tag
$updateTagRequest = new \Coderic\Contabo\Generated\Model\UpdateTagRequest(); // \Coderic\Contabo\Generated\Model\UpdateTagRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->updateTag($xRequestId, $tagId, $updateTagRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->updateTag: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **tagId** | **int**| The identifier of the tag | |
| **updateTagRequest** | [**\Coderic\Contabo\Generated\Model\UpdateTagRequest**](../Model/UpdateTagRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\UpdateTagResponse**](../Model/UpdateTagResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
