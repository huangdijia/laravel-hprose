<?php

namespace Huangdijia\Hprose\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \Huangdijia\Hprose\Server
 * @method static self setRouter(Router $router)
 * @method static void start()
 * @method static mixed getConfig($key = '', $default = null)
 * @method static \Huangdijia\Hprose\Server service(string $name = null)
 * @method static \Huangdijia\Hprose\Server[] services()
 */
class Server extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hprose.server';
    }
}
