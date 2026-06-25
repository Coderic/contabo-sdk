# # PrivateNetworkAuditResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The identifier of the audit entry. |
**privateNetworkId** | **float** | The identifier of the Private Network |
**action** | **string** | Type of the action. |
**timestamp** | **\DateTime** | When the change took place. |
**tenantId** | **string** | Customer tenant id |
**customerId** | **string** | Customer number |
**changedBy** | **string** | User id |
**username** | **string** | User name which did the change. |
**requestId** | **string** | The requestId of the API call which led to the change. |
**traceId** | **string** | The traceId of the API call which led to the change. |
**changes** | **object** | List of actual changes. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
