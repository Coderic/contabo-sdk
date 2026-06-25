# Coderic\Contabo\Generated\DNSApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**bulkDeleteDnsZoneRecords()**](DNSApi.md#bulkDeleteDnsZoneRecords) | **DELETE** /v1/dns/zones/{zoneName}/records/bulk | Bulk delete DNS zone records |
| [**createDnsZone()**](DNSApi.md#createDnsZone) | **POST** /v1/dns/zones | Create DNS zone |
| [**createDnsZoneRecord()**](DNSApi.md#createDnsZoneRecord) | **POST** /v1/dns/zones/{zoneName}/records | Create DNS zone record |
| [**createPtrRecord()**](DNSApi.md#createPtrRecord) | **POST** /v1/dns/ptrs | Create a new PTR Record using ip address |
| [**deleteDnsZone()**](DNSApi.md#deleteDnsZone) | **DELETE** /v1/dns/zones/{zoneName} | Delete a DNS zone. |
| [**deleteDnsZoneRecord()**](DNSApi.md#deleteDnsZoneRecord) | **DELETE** /v1/dns/zones/{zoneName}/records/{recordId} | Delete a DNS zone record |
| [**deletePtrRecord()**](DNSApi.md#deletePtrRecord) | **DELETE** /v1/dns/ptrs/{ipAddress} | Delete a PTR Record using ip address |
| [**retrieveDnsZone()**](DNSApi.md#retrieveDnsZone) | **GET** /v1/dns/zones/{zoneName} | Retrieve a DNS Zone by zone name |
| [**retrieveDnsZoneRecordsList()**](DNSApi.md#retrieveDnsZoneRecordsList) | **GET** /v1/dns/zones/{zoneName}/records | List a DNS Zone&#39;s records |
| [**retrieveDnsZonesList()**](DNSApi.md#retrieveDnsZonesList) | **GET** /v1/dns/zones | List DNS zones |
| [**retrievePtrRecord()**](DNSApi.md#retrievePtrRecord) | **GET** /v1/dns/ptrs/{ipAddress} | Retrieve a PTR Record by ip address |
| [**retrievePtrRecordsList()**](DNSApi.md#retrievePtrRecordsList) | **GET** /v1/dns/ptrs | List PTR records |
| [**updateDnsZoneRecord()**](DNSApi.md#updateDnsZoneRecord) | **PATCH** /v1/dns/zones/{zoneName}/records/{recordId} | Update DNS zone record |
| [**updatePtrRecord()**](DNSApi.md#updatePtrRecord) | **PUT** /v1/dns/ptrs/{ipAddress} | Edit a PTR Record by ip address |


## `bulkDeleteDnsZoneRecords()`

```php
bulkDeleteDnsZoneRecords($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId): \Coderic\Contabo\Generated\Model\ApiBulkDeleteDnsZoneRecordsResponse
```

Bulk delete DNS zone records

Delete multiple zone records from a DNS Zone

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$zoneName = example.com; // string | Zone name
$bulkDeleteDnsZoneRecordsRequest = new \Coderic\Contabo\Generated\Model\BulkDeleteDnsZoneRecordsRequest(); // \Coderic\Contabo\Generated\Model\BulkDeleteDnsZoneRecordsRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->bulkDeleteDnsZoneRecords($xRequestId, $zoneName, $bulkDeleteDnsZoneRecordsRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->bulkDeleteDnsZoneRecords: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **zoneName** | **string**| Zone name | |
| **bulkDeleteDnsZoneRecordsRequest** | [**\Coderic\Contabo\Generated\Model\BulkDeleteDnsZoneRecordsRequest**](../Model/BulkDeleteDnsZoneRecordsRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ApiBulkDeleteDnsZoneRecordsResponse**](../Model/ApiBulkDeleteDnsZoneRecordsResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createDnsZone()`

```php
createDnsZone($xRequestId, $createDnsZoneRequest, $xTraceId): \Coderic\Contabo\Generated\Model\ApiDnsZoneResponse
```

Create DNS zone

Creates a new DNS zone for a customer

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$createDnsZoneRequest = new \Coderic\Contabo\Generated\Model\CreateDnsZoneRequest(); // \Coderic\Contabo\Generated\Model\CreateDnsZoneRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createDnsZone($xRequestId, $createDnsZoneRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->createDnsZone: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **createDnsZoneRequest** | [**\Coderic\Contabo\Generated\Model\CreateDnsZoneRequest**](../Model/CreateDnsZoneRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ApiDnsZoneResponse**](../Model/ApiDnsZoneResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createDnsZoneRecord()`

```php
createDnsZoneRecord($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId): \Coderic\Contabo\Generated\Model\ApiDnsZoneRecordResponse
```

Create DNS zone record

Create resource record in a zone

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$zoneName = example.com; // string | Zone name
$createDnsZoneRecordRequest = new \Coderic\Contabo\Generated\Model\CreateDnsZoneRecordRequest(); // \Coderic\Contabo\Generated\Model\CreateDnsZoneRecordRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createDnsZoneRecord($xRequestId, $zoneName, $createDnsZoneRecordRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->createDnsZoneRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **zoneName** | **string**| Zone name | |
| **createDnsZoneRecordRequest** | [**\Coderic\Contabo\Generated\Model\CreateDnsZoneRecordRequest**](../Model/CreateDnsZoneRecordRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ApiDnsZoneRecordResponse**](../Model/ApiDnsZoneRecordResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createPtrRecord()`

```php
createPtrRecord($xRequestId, $createPtrRecordRequest, $xTraceId): \Coderic\Contabo\Generated\Model\ApiPtrRecordResponse
```

Create a new PTR Record using ip address

Create a new PTR Record using ip address. Only IPv6 can be created

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$createPtrRecordRequest = new \Coderic\Contabo\Generated\Model\CreatePtrRecordRequest(); // \Coderic\Contabo\Generated\Model\CreatePtrRecordRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createPtrRecord($xRequestId, $createPtrRecordRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->createPtrRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **createPtrRecordRequest** | [**\Coderic\Contabo\Generated\Model\CreatePtrRecordRequest**](../Model/CreatePtrRecordRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ApiPtrRecordResponse**](../Model/ApiPtrRecordResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteDnsZone()`

```php
deleteDnsZone($xRequestId, $zoneName, $xTraceId)
```

Delete a DNS zone.

Delete a DNS Zone using zone name.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$zoneName = example.com; // string | Zone name
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteDnsZone($xRequestId, $zoneName, $xTraceId);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->deleteDnsZone: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **zoneName** | **string**| Zone name | |
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

## `deleteDnsZoneRecord()`

```php
deleteDnsZoneRecord($xRequestId, $recordId, $zoneName, $xTraceId)
```

Delete a DNS zone record

Delete a DNZ Zone's record

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$recordId = 12345; // int | The identifier of the DNS record
$zoneName = example.com; // string | Zone name
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteDnsZoneRecord($xRequestId, $recordId, $zoneName, $xTraceId);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->deleteDnsZoneRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **recordId** | **int**| The identifier of the DNS record | |
| **zoneName** | **string**| Zone name | |
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

## `deletePtrRecord()`

```php
deletePtrRecord($xRequestId, $ipAddress, $xTraceId)
```

Delete a PTR Record using ip address

Delete a PTR Record using ip address. Only IPv6 can be deleted

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$ipAddress = 11.10.2.3; // string | Ip Address
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deletePtrRecord($xRequestId, $ipAddress, $xTraceId);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->deletePtrRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **ipAddress** | **string**| Ip Address | |
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

## `retrieveDnsZone()`

```php
retrieveDnsZone($xRequestId, $zoneName, $xTraceId)
```

Retrieve a DNS Zone by zone name

Get all attributes for a specific DNS Zone

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$zoneName = example.com; // string | Zone name
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->retrieveDnsZone($xRequestId, $zoneName, $xTraceId);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->retrieveDnsZone: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **zoneName** | **string**| Zone name | |
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

## `retrieveDnsZoneRecordsList()`

```php
retrieveDnsZoneRecordsList($xRequestId, $zoneName, $xTraceId, $page, $size, $orderBy, $search): \Coderic\Contabo\Generated\Model\ListDnsZoneRecordsResponse
```

List a DNS Zone's records

Get all the records of a DNS Zone

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$zoneName = example.com; // string | Zone name
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$orderBy = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$search = example.com; // string | Search DNS records by name, type or data

try {
    $result = $apiInstance->retrieveDnsZoneRecordsList($xRequestId, $zoneName, $xTraceId, $page, $size, $orderBy, $search);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->retrieveDnsZoneRecordsList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **zoneName** | **string**| Zone name | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **orderBy** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **search** | **string**| Search DNS records by name, type or data | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ListDnsZoneRecordsResponse**](../Model/ListDnsZoneRecordsResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveDnsZonesList()`

```php
retrieveDnsZonesList($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $zoneName): \Coderic\Contabo\Generated\Model\ListDnsZonesResponse
```

List DNS zones

Get a list of all zones

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
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
$customerId = 54321; // string | Customer ID
$tenantId = DE; // string | Tenant ID
$zoneName = example.com; // string | Seach by zone name

try {
    $result = $apiInstance->retrieveDnsZonesList($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $zoneName);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->retrieveDnsZonesList: ', $e->getMessage(), PHP_EOL;
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
| **customerId** | **string**| Customer ID | [optional] |
| **tenantId** | **string**| Tenant ID | [optional] |
| **zoneName** | **string**| Seach by zone name | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ListDnsZonesResponse**](../Model/ListDnsZonesResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrievePtrRecord()`

```php
retrievePtrRecord($xRequestId, $ipAddress, $xTraceId): \Coderic\Contabo\Generated\Model\ApiPtrRecordResponse
```

Retrieve a PTR Record by ip address

Get all attributes for a specific PTR Record

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$ipAddress = 11.10.2.3; // string | Ip Address
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrievePtrRecord($xRequestId, $ipAddress, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->retrievePtrRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **ipAddress** | **string**| Ip Address | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ApiPtrRecordResponse**](../Model/ApiPtrRecordResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrievePtrRecordsList()`

```php
retrievePtrRecordsList($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $ips, $search): \Coderic\Contabo\Generated\Model\ListPtrRecordsResponse
```

List PTR records

Get a list of all PTR records, either customer or a list of IPs is required

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
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
$customerId = 54321; // string | Customer ID
$tenantId = DE; // string | Tenant ID
$ips = array('ips_example'); // string[] | List of IPs, separated by commas
$search = vmd1111.contabo.net; // string | Search PTR records by ip or data

try {
    $result = $apiInstance->retrievePtrRecordsList($xRequestId, $xTraceId, $page, $size, $orderBy, $customerId, $tenantId, $ips, $search);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->retrievePtrRecordsList: ', $e->getMessage(), PHP_EOL;
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
| **customerId** | **string**| Customer ID | [optional] |
| **tenantId** | **string**| Tenant ID | [optional] |
| **ips** | [**string[]**](../Model/string.md)| List of IPs, separated by commas | [optional] |
| **search** | **string**| Search PTR records by ip or data | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ListPtrRecordsResponse**](../Model/ListPtrRecordsResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateDnsZoneRecord()`

```php
updateDnsZoneRecord($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId): \Coderic\Contabo\Generated\Model\ApiDnsZoneRecordResponse
```

Update DNS zone record

Create resource record in a zone

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$recordId = 12345; // int | The identifier of the DNS record
$zoneName = example.com; // string | Zone name
$updateDnsZoneRecordRequest = new \Coderic\Contabo\Generated\Model\UpdateDnsZoneRecordRequest(); // \Coderic\Contabo\Generated\Model\UpdateDnsZoneRecordRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->updateDnsZoneRecord($xRequestId, $recordId, $zoneName, $updateDnsZoneRecordRequest, $xTraceId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->updateDnsZoneRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **recordId** | **int**| The identifier of the DNS record | |
| **zoneName** | **string**| Zone name | |
| **updateDnsZoneRecordRequest** | [**\Coderic\Contabo\Generated\Model\UpdateDnsZoneRecordRequest**](../Model/UpdateDnsZoneRecordRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\Coderic\Contabo\Generated\Model\ApiDnsZoneRecordResponse**](../Model/ApiDnsZoneRecordResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updatePtrRecord()`

```php
updatePtrRecord($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId)
```

Edit a PTR Record by ip address

Edit attributes for a specific PTR Record

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = Coderic\Contabo\Generated\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Coderic\Contabo\Generated\Api\DNSApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xRequestId = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$ipAddress = 11.10.2.3; // string | Ip Address
$updatePtrRecordRequest = new \Coderic\Contabo\Generated\Model\UpdatePtrRecordRequest(); // \Coderic\Contabo\Generated\Model\UpdatePtrRecordRequest
$xTraceId = 'xTraceId_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->updatePtrRecord($xRequestId, $ipAddress, $updatePtrRecordRequest, $xTraceId);
} catch (Exception $e) {
    echo 'Exception when calling DNSApi->updatePtrRecord: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xRequestId** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **ipAddress** | **string**| Ip Address | |
| **updatePtrRecordRequest** | [**\Coderic\Contabo\Generated\Model\UpdatePtrRecordRequest**](../Model/UpdatePtrRecordRequest.md)|  | |
| **xTraceId** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

void (empty response body)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
