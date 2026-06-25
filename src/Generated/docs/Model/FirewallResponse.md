# # FirewallResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenantId** | **string** | Your customer tenant id |
**customerId** | **string** | Your customer number |
**firewallId** | **string** | Your firewall id. |
**name** | **string** | The name of the firewall. |
**description** | **string** | The description of the firewall. |
**status** | **string** | Inactive status means no rules of this firewall are set for all assigned instances. |
**instanceStatus** | [**\Coderic\Contabo\Generated\Model\InstanceStatusRepresentation[]**](InstanceStatusRepresentation.md) |  |
**instances** | [**\Coderic\Contabo\Generated\Model\InstanceDetails[]**](InstanceDetails.md) |  |
**rules** | [**\Coderic\Contabo\Generated\Model\Rules**](Rules.md) |  |
**createdDate** | **\DateTime** | The creation date time for the firewall |
**updatedDate** | **\DateTime** | The update date time for the firewall |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
