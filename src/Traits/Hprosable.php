<?php

namespace Huangdijia\Hprose\Traits;

use Hprose\Http\Server;
use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionMethod;

trait Hprosable
{
    public function __invoke(Request $request)
    {
        (new Server())
            ->addMethods($this->getMethods(), $this)
            ->start();
    }

    /**
     * Get methods
     * @return array
     */
    protected function getMethods()
    {
        if (isset($this->allowMethods) && is_array($this->allowMethods)) {
            return $this->allowMethods ?: [];
        }

        $class = new ReflectionClass(get_class($this));

        return collect($class->getMethods(ReflectionMethod::IS_PUBLIC))
            ->reject(function ($method) {
                return in_array($method->name, ['__construct', '__call', '__invoke']);
            })
            ->transform(function ($method) {
                return $method->name;
            })
            ->all();
    }
}
