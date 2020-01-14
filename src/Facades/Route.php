<?php

namespace Huangdijia\Hprose\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \Huangdijia\Hprose\Routing\Router
 * @method static \Huangdijia\Hprose\Routing\Route add($name, $action)
 * @method static \Huangdijia\Hprose\Routing\Route addRoute($name, $action)
 * @method static void group(array $attributes, $routes)
 * @method static \Huangdijia\Hprose\Routing\RouteCollection getRoutes()
 * @method static \Huangdijia\Hprose\Routing\RouteCollection getRouteCollection()
 * @method static \Huangdijia\Hprose\Routing\Router getRouter()
 */
class Route extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hprose.router';
    }
}
