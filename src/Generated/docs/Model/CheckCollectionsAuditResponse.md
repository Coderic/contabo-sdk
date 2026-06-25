# # CheckCollectionsAuditResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**createdDate** | **\DateTime** | Creation date |
**modifiedDate** | **\DateTime** | Modify date |
**orgId** | **string** | Org id |
**accountId** | **string** | Account id |
**auditId** | **int** | The ID of the audit entry. |
**action** | **string** | Type of the action. |
**foreignChangedBy** | **string** | Id of a foreign user (given on the api request via header) who performed the change |
**foreignUsername** | **string** | Name of the foreign user (given on the api request via header) which led to the change. |
**changedBy** | **string** | Id of user who performed the change |
**username** | **string** | Name of the user which led to the change. |
**requestId** | **string** | The requestId of the API call which led to the change. |
**traceId** | **string** | The traceId of the API call which led to the change. |
**changes** | [**\Coderic\Contabo\Generated\Model\Changes**](Changes.md) | List of changed properties |
**checkCollectionId** | **float** | Check collection&#39;s id |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
