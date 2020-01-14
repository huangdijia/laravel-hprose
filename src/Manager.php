<?php

namespace Huangdijia\Hprose;

use Exception;
use Hprose\Http\Server as HttpServer;
use Hprose\Socket\Server as SocketServer;
use Illuminate\Support\Arr;

class Manager
{
    /**
     * @var \Huangdijia\Hprose\Server[] | array
     */
    protected $servers = [];

    /**
     * 构造实例
     * @param \Illuminate\Contracts\Foundation\Application
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * 获取配置
     * @param string $key 
     * @param mixed|null $default 
     * @return mixed 
     */
    public function getConfig($key = '', $default = null)
    {
        return Arr::get($this->app['config']['hprose.server'], $key, $default);
    }

    /**
     * 服务
     * @param string|null $mode 
     * @return Huangdijia\Hprose\Server
     * @throws Exception 
     */
    public function server(string $mode = null)
    {
        $mode = $mode ?: $this->getConfig('defaut', 'http');

        if (!isset($this->servers[$mode])) {
            $uri      = $this->getConfig('modes.' . $mode . '.uri', 'tcp://0.0.0.0:1314');
            $protocol = $this->getConfig('modes.' . $mode . '.protocol', 'http');

            switch ($protocol) {
                case 'socket':
                    $this->servers[$mode] = $this->createSocketServer($uri);
                    break;
                case 'http':
                    $this->servers[$mode] = $this->createHttpServer();
                    break;
                default:
                    throw new \Exception("Not support '{$protocol}' type!", 1);
                    break;
            }
        }

        return $this->servers[$mode];
    }

    /**
     * 所有服务
     * @return \Huangdijia\Hprose\Server[] 
     */
    public function servers()
    {
        return $this->servers;
    }

    /**
     * 创建 HTTP 服务
     * @return Huangdijia\Hprose\Server 
     */
    protected function createHttpServer()
    {
        return new Server(new HttpServer());
    }

    /**
     * 创建 socket 服务
     * @param string $uri 
     * @return Huangdijia\Hprose\Server 
     */
    protected function createSocketServer(string $uri)
    {
        return new Server(new SocketServer($uri));
    }

    /**
     * 魔术方法
     * @param mixed $name 
     * @param array $args 
     * @return mixed 
     * @throws Exception 
     */
    public function __call($name, $args = [])
    {
        return call_user_func_array([$this->service(), $name], $args);
    }
}
