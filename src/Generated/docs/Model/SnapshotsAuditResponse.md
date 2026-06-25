# # SnapshotsAuditResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The ID of the audit entry. |
**action** | **string** | Type of the action. |
**timestamp** | **\DateTime** | When the change took place. |
**tenantId** | **string** | Customer tenant id |
**customerId** | **string** | Customer ID |
**changedBy** | **string** | Id of user who performed the change |
**username** | **string** | Name of the user which led to the change. |
**requestId** | **string** | The requestId of the API call which led to the change. |
**traceId** | **string** | The traceId of the API call which led to the change. |
**instanceId** | **int** | The identifier of the instance |
**snapshotId** | **string** | The identifier of the snapshot |
**changes** | **object** | List of actual changes | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
