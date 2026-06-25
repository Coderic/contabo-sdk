# # FirewallRuleRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**protocol** | **string** | Protocol for incoming traffic to be allowed. ‘tcp‘, ´udp´, ´icmp´ or ´´ empty value are allowed. Empty means any traffic. |
**destPorts** | **string[]** | Ports to specify allowed traffic. Not available for protocol &#x60;ICMP&#x60;. Port ranges can specified like in example. |
**srcCidr** | [**\Contabo\Generated\Model\SrcCidr**](SrcCidr.md) | Source CIDR configuration. Use \&quot;AnyIPv4\&quot; to allow all IPv4 sources (0.0.0.0/0) or \&quot;AnyIPv6\&quot; to allow all IPv6 sources (::/0). Both can be combined to allow all IP sources. Regular CIDR notation is also supported. |
**action** | **string** | Currently only &#x60;accept&#x60; is supported. |
**status** | **string** | Status of the inbound rule. An inactive rule is removed from all assigned instances. |
**displayName** | **string** | Display name for the firewall rule. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
