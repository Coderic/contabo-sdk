# # InstancesResetPasswordActionsRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**sshKeys** | **int[]** | Array of &#x60;secretId&#x60;s of public SSH keys for logging into as &#x60;defaultUser&#x60; with administrator/root privileges. Applies to Linux/BSD systems. Please refer to Secrets Management API. | [optional]
**rootPassword** | **int** | &#x60;secretId&#x60; of the password for the &#x60;defaultUser&#x60; with administrator/root privileges. For Linux/BSD please use SSH, for Windows RDP. Please refer to Secrets Management API. | [optional]
**userData** | **string** | [Cloud-Init](https://cloud-init.io/) Config in order to customize during start of compute instance. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
