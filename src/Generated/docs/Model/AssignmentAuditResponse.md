# # AssignmentAuditResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenantId** | **string** | Your customer tenant id |
**customerId** | **string** | Your customer number |
**id** | **float** | The identifier of the audit entry. |
**resourceId** | **string** | Resource&#39;s id |
**resourceType** | **string** | Resource type. Resource type is one of &#x60;instance|image|object-storage&#x60;. |
**tagId** | **int** | Tag&#39;s id |
**action** | **string** | Audit Action |
**timestamp** | **\DateTime** | Audit creation date |
**changedBy** | **string** | User ID |
**username** | **string** | User Full Name |
**requestId** | **string** | Request ID |
**traceId** | **string** | Trace ID |
**changes** | **object** | Changes made for a specific Tag | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
