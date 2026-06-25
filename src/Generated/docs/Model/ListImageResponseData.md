# # ListImageResponseData

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**imageId** | **string** | Image&#39;s id |
**tenantId** | **string** | Your customer tenant id |
**customerId** | **string** | Customer ID |
**name** | **string** | Image Name |
**description** | **string** | Image Description |
**url** | **string** | URL from where the image has been downloaded / provided. |
**sizeMb** | **float** | Image Size in MB |
**uploadedSizeMb** | **float** | Image Uploaded Size in MB |
**osType** | **string** | Type of operating system (OS) |
**version** | **string** | Version number to distinguish the contents of an image. Could be the version of the operating system for example. |
**format** | **string** | Image format |
**status** | **string** | Image status (e.g. if image is still downloading) |
**errorMessage** | **string** | Image download error message |
**standardImage** | **bool** | Flag indicating that image is either a standard (true) or a custom image (false) |
**creationDate** | **\DateTime** | The creation date time for the image |
**lastModifiedDate** | **\DateTime** | The last modified date time for the image |
**tags** | [**\Contabo\Generated\Model\AssignedTagResponse[]**](AssignedTagResponse.md) | The tags assigned to the image |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
