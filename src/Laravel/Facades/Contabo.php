<?php

declare(strict_types=1);

namespace Contabo\Laravel\Facades;

use Contabo\ContaboClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Contabo\ApiResourceProxy instances()
 * @method static \Contabo\ApiResourceProxy objectStorages()
 * @method static \Contabo\ApiResourceProxy domains()
 * @method static \Contabo\ApiResourceProxy dns()
 * @method static \Contabo\ApiResourceProxy firewalls()
 *
 * @see ContaboClient
 */
final class Contabo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'contabo';
    }
}
