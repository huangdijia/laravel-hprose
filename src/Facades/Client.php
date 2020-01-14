<?php

namespace Huangdijia\Hprose\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \Huangdijia\Hprose\Client
 */
class Client extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hprose.client';
    }
}
