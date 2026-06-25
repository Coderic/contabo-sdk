# # CreateObjectStorageRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**region** | **string** | Region where the object storage should be located. Default is EU. Available regions: EU, US-central, SIN | [default to 'EU']
**autoScaling** | [**\Coderic\Contabo\Generated\Model\AutoScalingTypeRequest**](AutoScalingTypeRequest.md) | Autoscaling settings | [optional]
**totalPurchasedSpaceTB** | **float** | Amount of purchased / requested object storage in TB. |
**displayName** | **string** | Display name helps to differentiate between object storages, especially if they are in the same region. If display name is not provided, it will be generated. Display name can be changed any time. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
