# # ExtCheckCollectionResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** | Status of the handle |
**objectType** | **string** | Object type to be handled |
**objectId** | **string** | ID of the object, to be handled |
**checkCollectionId** | **float** | Check collection&#39;s id |
**checkCollectionTemplateId** | **float** | Check Collection Template for this check collection |
**checkTemplates** | [**\Contabo\Generated\Model\CheckCollectionCheckTemplates[]**](CheckCollectionCheckTemplates.md) | Check templates which are part of this collection template |
**createdDate** | **\DateTime** | Creation date |
**modifiedDate** | **\DateTime** | Modify date |
**tenantId** | **string** | Tenant id |
**customerId** | **string** | Customer id |
**checks** | [**\Contabo\Generated\Model\ExtCheckResponse[]**](ExtCheckResponse.md) | Checks performed in this check collection |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
