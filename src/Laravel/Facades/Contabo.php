<?php

declare(strict_types=1);

namespace Coderic\Contabo\Laravel\Facades;

use Coderic\Contabo\ContaboClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Coderic\Contabo\ApiResourceProxy instances()
 * @method static \Coderic\Contabo\ApiResourceProxy objectStorages()
 * @method static \Coderic\Contabo\ApiResourceProxy domains()
 * @method static \Coderic\Contabo\ApiResourceProxy dns()
 * @method static \Coderic\Contabo\ApiResourceProxy firewalls()
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
