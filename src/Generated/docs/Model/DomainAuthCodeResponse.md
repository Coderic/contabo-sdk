# # DomainAuthCodeResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenantId** | **string** | Your customer tenant id |
**customerId** | **string** | Your customer number |
**domain** | **string** | Domain name |
**domainDetails** | [**\Coderic\Contabo\Generated\Model\DomainDetails**](DomainDetails.md) | Domain Details |
**status** | **string** | Domain Status |
**nameservers** | **string[]** | Nameservers |
**handles** | [**\Coderic\Contabo\Generated\Model\DomainHandles**](DomainHandles.md) | The handles of the domain |
**registrationDate** | **\DateTime** | The registration date of domain |
**renewalDate** | **\DateTime** | The renewal date of domain |
**terminationDate** | **\DateTime** | The termination date of domain |
**cancelDate** | **\DateTime** | The cancel date of domain |
**dnssecKeys** | **string[]** | DNSSEC keys |
**transferOutConfirmation** | **bool** | Transfer out confirmation |
**authCode** | **string** | Your auth code of the domain |
**authCodeChanged** | [**\Coderic\Contabo\Generated\Model\ChangedAuthCode**](ChangedAuthCode.md) | Details if the auth code has been changed |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
