# # CreateInstanceAddons

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**privateNetworking** | **array<string,mixed>** | Set this attribute if you want to upgrade your instance with the Private Networking addon.   Please provide an empty object for the time being as value. There will be more configuration possible   in the future. | [optional]
**additionalIps** | **array<string,mixed>** | Set this attribute if you want to upgrade your instance with the Additional IPs addon. Please provide an empty object for the time being as value. There will be more configuration possible in the future. | [optional]
**backup** | **array<string,mixed>** | Set this attribute if you want to upgrade your instance with the Automated backup addon.     Please provide an empty object for the time being as value. There will be more configuration possible     in the future. | [optional]
**extraStorage** | [**\Coderic\Contabo\Generated\Model\ExtraStorageRequest**](ExtraStorageRequest.md) | Set this attribute if you want to upgrade your instance with the Extra Storage addon. | [optional]
**customImage** | **array<string,mixed>** | Set this attribute if you want to upgrade your instance with the Custom Images addon.   Please provide an empty object for the time being as value. There will be more configuration possible   in the future. | [optional]
**addonsIds** | [**\Coderic\Contabo\Generated\Model\AddOnRequest[]**](AddOnRequest.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
