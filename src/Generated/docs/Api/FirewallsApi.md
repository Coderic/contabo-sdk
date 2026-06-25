# Coderic\Contabo\Generated\FirewallsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**assignInstanceFirewall()**](FirewallsApi.md#assignInstanceFirewall) | **POST** /v1/firewalls/{firewallId}/instances/{instanceId} | Add instance to a firewall |
| [**createFirewall()**](FirewallsApi.md#createFirewall) | **POST** /v1/firewalls | Create a new firewall definition |
| [**deleteFirewall()**](FirewallsApi.md#deleteFirewall) | **DELETE** /v1/firewalls/{firewallId} | Delete existing firewall by id |
| [**patchFirewall()**](FirewallsApi.md#patchFirewall) | **PATCH** /v1/firewalls/{firewallId} | Update a firewall by id |
| [**putFirewall()**](FirewallsApi.md#putFirewall) | **PUT** /v1/firewalls/{firewallId} | Update specific firewall rules |
| [**retrieveFirewall()**](FirewallsApi.md#retrieveFirewall) | **GET** /v1/firewalls/{firewallId} | Get specific firewall by its id |
| [**retrieveFirewallList()**](FirewallsApi.md#retrieveFirewallList) | **GET** /v1/firewalls | List all firewalls |
| [**retrievePresetRules()**](FirewallsApi.md#retrievePresetRules) | **GET** /v1/firewalls/preset-rules | Get all preset rules |
| [**unassignInstanceFirewall()**](FirewallsApi.md#unassignInstanceFirewall) | **DELETE** /v1/firewalls/{firewallId}/instances/{instanceId} | Remove instance from a firewall |


## `assignInstanceFirewall()`

```php
assignInstanceFirewall($xRequestId, $firewallId, $instanceId, $xTraceId): \Coderic\Contabo\Generated\Model\AssignInstanceFirewallResponse
```

Add instance to a firewall

Add a specific instance to a firewall

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewallId = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$instanceId = 100; // int | The identifier of the instance
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->assignInstanceFirewall($xRequestId, $firewallId, $instanceId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->assignInstanceFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **firewallId** | **string**| The identifier of the firewall | |
| **instanceId** | **int**| The identifier of the instance | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\AssignInstanceFirewallResponse**](../Model/AssignInstanceFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createFirewall()`

```php
createFirewall($xRequestId, $createFirewallRequest, $xTraceId): \Coderic\Contabo\Generated\Model\CreateFirewallResponse
```

Create a new firewall definition

Create a new firewall definition by specifying its name and a set of rules. The status of the firewall determines whether the rules are active or not.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$createFirewallRequest = new \Coderic\Contabo\Generated\Model\CreateFirewallRequest(); // \Coderic\Contabo\Generated\Model\CreateFirewallRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createFirewall($xRequestId, $createFirewallRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->createFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **createFirewallRequest** | [**\Coderic\Contabo\Generated\Model\CreateFirewallRequest**](../Model/CreateFirewallRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\CreateFirewallResponse**](../Model/CreateFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteFirewall()`

```php
deleteFirewall($xRequestId, $firewallId, $xTraceId)
```

Delete existing firewall by id

Delete existing firewall by id. A firewall cannot be deleted if there are instances attached to it.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewallId = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteFirewall($xRequestId, $firewallId, $xTraceId);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->deleteFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **firewallId** | **string**| The identifier of the firewall | |
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

## `patchFirewall()`

```php
patchFirewall($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId): \Coderic\Contabo\Generated\Model\PatchFirewallResponse
```

Update a firewall by id

Update a firewall by id in your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewallId = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$patchFirewallRequest = new \Coderic\Contabo\Generated\Model\PatchFirewallRequest(); // \Coderic\Contabo\Generated\Model\PatchFirewallRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->patchFirewall($xRequestId, $firewallId, $patchFirewallRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->patchFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **firewallId** | **string**| The identifier of the firewall | |
| **patchFirewallRequest** | [**\Coderic\Contabo\Generated\Model\PatchFirewallRequest**](../Model/PatchFirewallRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\PatchFirewallResponse**](../Model/PatchFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `putFirewall()`

```php
putFirewall($xRequestId, $firewallId, $putFirewallRequest, $xTraceId): \Coderic\Contabo\Generated\Model\PutFirewallResponse
```

Update specific firewall rules

Set rules for a specific firewall. Currently only inbound rules are allowed to be configured.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewallId = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$putFirewallRequest = new \Coderic\Contabo\Generated\Model\PutFirewallRequest(); // \Coderic\Contabo\Generated\Model\PutFirewallRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->putFirewall($xRequestId, $firewallId, $putFirewallRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->putFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **firewallId** | **string**| The identifier of the firewall | |
| **putFirewallRequest** | [**\Coderic\Contabo\Generated\Model\PutFirewallRequest**](../Model/PutFirewallRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\PutFirewallResponse**](../Model/PutFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveFirewall()`

```php
retrieveFirewall($xRequestId, $firewallId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds): \Coderic\Contabo\Generated\Model\FindFirewallResponse
```

Get specific firewall by its id

Get data for a specific firewall on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewallId = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$orderBy = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$name = My Firewall; // string | The name of the firewall
$instanceIds = 12345,67890; // string | Comma separated instance IDs.

try {
    $result = $apiInstance->retrieveFirewall($xRequestId, $firewallId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->retrieveFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **firewallId** | **string**| The identifier of the firewall | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **orderBy** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **name** | **string**| The name of the firewall | [optional] |
| **instanceIds** | **string**| Comma separated instance IDs. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\FindFirewallResponse**](../Model/FindFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveFirewallList()`

```php
retrieveFirewallList($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds): \Coderic\Contabo\Generated\Model\ListFirewallResponse
```

List all firewalls

List and filter all firewalls on your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\FirewallsApi(
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
$name = My Firewall; // string | The name of the firewall
$instanceIds = 12345,67890; // string | Comma separated instance IDs.

try {
    $result = $apiInstance->retrieveFirewallList($xRequestId, $xTraceId, $page, $size, $orderBy, $name, $instanceIds);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->retrieveFirewallList: ', $e->getMessage(), PHP_EOL;
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
| **name** | **string**| The name of the firewall | [optional] |
| **instanceIds** | **string**| Comma separated instance IDs. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ListFirewallResponse**](../Model/ListFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrievePresetRules()`

```php
retrievePresetRules($xRequestId, $xTraceId, $page, $size, $orderBy, $name): \Coderic\Contabo\Generated\Model\ListPresetRulesResponse
```

Get all preset rules

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\FirewallsApi(
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
$name = SSH; // string | The name of preset rule

try {
    $result = $apiInstance->retrievePresetRules($xRequestId, $xTraceId, $page, $size, $orderBy, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->retrievePresetRules: ', $e->getMessage(), PHP_EOL;
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
| **name** | **string**| The name of preset rule | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ListPresetRulesResponse**](../Model/ListPresetRulesResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `unassignInstanceFirewall()`

```php
unassignInstanceFirewall($xRequestId, $firewallId, $instanceId, $xTraceId): \Coderic\Contabo\Generated\Model\UnassignInstanceFirewallResponse
```

Remove instance from a firewall

Remove a specific instance from a firewall

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewallId = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$instanceId = 100; // int | The identifier of the instance
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->unassignInstanceFirewall($xRequestId, $firewallId, $instanceId, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->unassignInstanceFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **firewallId** | **string**| The identifier of the firewall | |
| **instanceId** | **int**| The identifier of the instance | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\UnassignInstanceFirewallResponse**](../Model/UnassignInstanceFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
