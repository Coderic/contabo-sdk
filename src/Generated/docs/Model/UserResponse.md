# # UserResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenantId** | **string** | Your customer tenant id |
**customerId** | **string** | Your customer number |
**userId** | **string** | The identifier of the user. |
**firstName** | **string** | The first name of the user. Users may contain letters, numbers, colons, dashes, and underscores. There is a limit of 255 characters per user. |
**lastName** | **string** | The last name of the user. Users may contain letters, numbers, colons, dashes, and underscores. There is a limit of 255 characters per user. |
**email** | **string** | The email of the user to which activation and forgot password links are being sent to. There is a limit of 255 characters per email. |
**emailVerified** | **bool** | User email verification status. |
**enabled** | **bool** | If uses is not enabled, he can&#39;t login and thus use services any longer. |
**totp** | **bool** | Enable or disable two-factor authentication (2FA) via time based OTP. |
**locale** | **string** | The locale of the user. This can be &#x60;de-DE&#x60;, &#x60;de&#x60;, &#x60;en-US&#x60;, &#x60;en&#x60;, &#x60;es-ES&#x60;, &#x60;es&#x60;, &#x60;pt-BR&#x60;, &#x60;pt&#x60;. |
**roles** | [**\Coderic\Contabo\Generated\Model\RoleResponse[]**](RoleResponse.md) | The roles as list of &#x60;roleId&#x60;s of the user. |
**owner** | **bool** | If user is owner he will have permissions to all API endpoints and resources. Enabling this will superseed all role definitions and &#x60;accessAllResources&#x60;. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
