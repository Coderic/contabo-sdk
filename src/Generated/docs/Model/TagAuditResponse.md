# # TagAuditResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenantId** | **string** | Your customer tenant id |
**customerId** | **string** | Your customer number |
**id** | **float** | The identifier of the audit entry. |
**tagId** | **int** | The identifier of the audit entry. |
**action** | **string** | Type of the action. |
**timestamp** | **\DateTime** | When the change took place. |
**changedBy** | **string** | User ID |
**username** | **string** | Name of the user which led to the change. |
**requestId** | **string** | The requestId of the API call which led to the change. |
**traceId** | **string** | The traceId of the API call which led to the change. |
**changes** | **object** | List of actual changes. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
