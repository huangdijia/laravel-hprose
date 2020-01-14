<?php

namespace Huangdijia\Hprose;

use Exception;
use Hprose\Service;
use Huangdijia\Hprose\Routing\Router;

class Server
{
    private $server;
    private $router;

    public function __construct(Service $server, Router $router = null)
    {
        $this->server = $server;
        $this->router = $router;
    }

    /**
     * 设置路由
     * @param Router $router
     * @return self
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;

        return $this;
    }

    /**
     * 增加方法
     * @return void
     * @throws Exception
     */
    protected function addFunctions()
    {
        foreach ($this->router->getRoutes() as $route) {
            $this->server->addFunction($route->getCallback(), $route->getName(), $route->getOptions());
        }
    }

    /**
     * 启动服务
     * @return void
     * @throws Exception
     */
    public function start()
    {
        $this->addFunctions();

        $this->server->start();
    }
}
