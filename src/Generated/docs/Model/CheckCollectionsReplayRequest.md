# # CheckCollectionsReplayRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**orgId** | **string** | Id of your organization, if unknown please contact us |
**accountId** | **string** | Account Id |
**creationStartTime** | **\DateTime** | Earliest creation date of changes to replay | [optional]
**creationEndTime** | **\DateTime** | Latest creation date of changes to replay | [optional]
**rate** | **float** | Message publishing frequency. How many messages per second get published. Default: 20 | [optional]
**checkCollectionIds** | **float[]** | Check collection&#39;s id | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
