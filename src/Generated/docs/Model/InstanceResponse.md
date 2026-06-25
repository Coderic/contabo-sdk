# # InstanceResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenantId** | **string** | Your customer tenant id |
**customerId** | **string** | Customer ID |
**additionalIps** | [**\Contabo\Generated\Model\AdditionalIp[]**](AdditionalIp.md) |  |
**name** | **string** | Instance Name |
**displayName** | **string** | Instance display name |
**instanceId** | **int** | Instance ID |
**dataCenter** | **string** | The data center where your Private Network is located |
**region** | **string** | Instance region where the compute instance should be located. |
**regionName** | **string** | The name of the region where the instance is located. |
**productId** | **string** | Product ID |
**imageId** | **string** | Image&#39;s id |
**ipConfig** | [**\Contabo\Generated\Model\IpConfig2**](IpConfig2.md) |  |
**macAddress** | **string** | MAC Address |
**ramMb** | **float** | Image RAM size in MB |
**cpuCores** | **int** | CPU core count |
**osType** | **string** | Type of operating system (OS) |
**diskMb** | **float** | Image Disk size in MB |
**sshKeys** | **int[]** | Array of &#x60;secretId&#x60;s of public SSH keys for logging into as &#x60;defaultUser&#x60; with administrator/root privileges. Applies to Linux/BSD systems. Please refer to Secrets Management API. |
**createdDate** | **\DateTime** | The creation date for the instance |
**cancelDate** | **\DateTime** | The date on which the instance will be cancelled |
**status** | [**\Contabo\Generated\Model\InstanceStatus**](InstanceStatus.md) | Instance&#39;s status |
**vHostId** | **int** | ID of host system |
**vHostNumber** | **int** | Number of host system |
**vHostName** | **string** | Name of host system |
**addOns** | [**\Contabo\Generated\Model\AddOnResponse[]**](AddOnResponse.md) |  |
**errorMessage** | **string** | Message in case of an error. | [optional]
**productType** | **string** | Instance&#39;s category depending on Product Id |
**productName** | **string** | Instance&#39;s Product Name |
**defaultUser** | **string** | Default user name created for login during (re-)installation with administrative privileges. Allowed values for Linux/BSD are &#x60;admin&#x60; (use sudo to apply administrative privileges like root) or &#x60;root&#x60;. Allowed values for Windows are &#x60;admin&#x60; (has administrative privileges like administrator) or &#x60;administrator&#x60;. | [optional]
**applicationId** | **string** | Application ID |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
