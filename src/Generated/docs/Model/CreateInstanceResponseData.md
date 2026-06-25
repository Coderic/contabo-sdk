# # CreateInstanceResponseData

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenantId** | **string** | Your customer tenant id |
**customerId** | **string** | Your customer number |
**instanceId** | **int** | Instance&#39;s id |
**createdDate** | **\DateTime** | Creation date for instance |
**imageId** | **string** | Image&#39;s id |
**productId** | **string** | Product ID |
**region** | **string** | Instance Region where the compute instance should be located. |
**addOns** | [**\Contabo\Generated\Model\AddOnResponse[]**](AddOnResponse.md) |  |
**osType** | **string** | Type of operating system (OS) |
**status** | [**\Contabo\Generated\Model\InstanceStatus**](InstanceStatus.md) | Instance&#39;s status |
**sshKeys** | **int[]** | Array of &#x60;secretId&#x60;s of public SSH keys for logging into as &#x60;defaultUser&#x60; with administrator/root privileges. Applies to Linux/BSD systems. Please refer to Secrets Management API. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
