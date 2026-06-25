# # ObjectStorageResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenantId** | **string** | Your customer tenant id |
**customerId** | **string** | Your customer number |
**objectStorageId** | **string** | Your object storage id |
**createdDate** | **\DateTime** | Creation date for object storage. |
**cancelDate** | **\DateTime** | Cancellation date for object storage. |
**autoScaling** | [**\Contabo\Generated\Model\AutoScalingTypeResponse**](AutoScalingTypeResponse.md) | Autoscaling settings |
**dataCenter** | **string** | Data center your object storage is located |
**totalPurchasedSpaceTB** | **float** | Amount of purchased / requested object storage in TB. |
**s3Url** | **string** | S3 URL to connect to your S3 compatible object storage |
**s3TenantId** | **string** | Your S3 tenantId. Only required for public sharing. |
**status** | **string** | The object storage status |
**region** | **string** | The region where your object storage is located |
**displayName** | **string** | Display name for object storage. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
