# Coderic Contabo SDK

SDK PHP para la API de Contabo v1, construido desde el OpenAPI oficial de `contabo/cntb` y envuelto con una capa manual para OAuth2, `x-request-id` automático y uso opcional en Laravel.

## Instalación

```bash
composer require coderic/contabo-sdk
```

## Uso PHP

```php
use Coderic\Contabo\Auth\Credentials;
use Coderic\Contabo\ContaboClient;

$client = ContaboClient::fromCredentials(new Credentials(
    clientId: getenv('CONTABO_CLIENT_ID'),
    clientSecret: getenv('CONTABO_CLIENT_SECRET'),
    apiUser: getenv('CONTABO_API_USER'),
    apiPassword: getenv('CONTABO_API_PASSWORD'),
));

$instances = $client->instances()->retrieveInstancesList();
```

El wrapper agrega `Authorization: Bearer ...` y `x-request-id` automáticamente. Si Contabo responde `401`, el SDK solicita un token nuevo y reintenta una vez.

## Uso Laravel

Publica la configuración:

```bash
php artisan vendor:publish --tag=contabo-config
```

Variables de entorno:

```dotenv
CONTABO_CLIENT_ID=
CONTABO_CLIENT_SECRET=
CONTABO_API_USER=
CONTABO_API_PASSWORD=
CONTABO_TRACE_ID=coderic-contabo-sdk
```

Ejemplo:

```php
use Coderic\Contabo\Laravel\Facades\Contabo;

$images = Contabo::images()->listImages();
```

## Cobertura API

El cliente generado cubre el OpenAPI oficial actual:

- 90 paths `/v1/*`
- 169 operaciones HTTP
- Compute, Object Storage, Private Networks, Users, Roles, Tags, Secrets, VIP, Domains, DNS, Firewalls y Troubleshooting

La documentación pública de Contabo se encuentra en [api.contabo.com](https://api.contabo.com/). La especificación vendoreada se sincroniza desde:

```text
https://raw.githubusercontent.com/contabo/cntb/master/openapi/api/openapi.yaml
```

## Desarrollo

```bash
composer install
composer test
composer analyse
composer format:check
composer sync-openapi
composer generate-client
```

Para verificar si el OpenAPI local difiere del oficial:

```bash
bash scripts/diff-openapi.sh
```

## Seguridad

No hagas commit de credenciales reales. Las operaciones destructivas de Contabo (`cancel`, `delete`, `reinstall`, `shutdown`, etc.) afectan recursos y costos reales.

## Licencia

MIT.
