# # RoleAuditResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The identifier of the audit entry. |
**action** | **string** | Type of the action. |
**timestamp** | **\DateTime** | When the change took place. |
**tenantId** | **string** | Customer tenant id |
**customerId** | **string** | Customer number |
**changedBy** | **string** | User ID |
**username** | **string** | Name of the user which led to the change. |
**requestId** | **string** | The requestId of the API call which led to the change. |
**traceId** | **string** | The traceId of the API call which led to the change. |
**roleId** | **float** | The identifier of the role |
**changes** | **object** | List of actual changes. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
