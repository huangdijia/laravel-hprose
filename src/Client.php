<?php

namespace Huangdijia\Hprose;

use Exception;
use Illuminate\Support\Arr;

class Client
{
    /**
     * 连接池 \Hprose\Http\Client[]|\Hprose\Socket\Client[]
     * @var
     */
    protected $connections = [];

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
        return Arr::get($this->app['config']['hprose.client'], $key, $default);
    }

    /**
     * 简历连接
     * @param string|null $name
     * @return \Hprose\Http\Client|\Hprose\Socket\Client
     * @throws Exception
     */
    public function connection(string $name = null)
    {
        $name = $name ?: $this->getConfig('default', 'http');

        if (!isset($this->connections[$name])) {
            $protocol = $this->getConfig('connections.' . $name . '.protocol', 'http');
            $uri      = $this->getConfig('connections.' . $name . '.uri', 'tcp://0.0.0.0:1314');
            $host     = $this->getConfig('connections.' . $name . '.host', '');
            $async    = $this->getConfig('connections.' . $name . '.async', false);

            switch ($protocol) {
                case 'socket':
                    $this->connections[$name] = $this->createSocketClient($uri, $async);
                    break;
                case 'http':
                    $this->connections[$name] = $this->createHttpClient($uri, $async);
                    break;
                default:
                    throw new \Exception("Not support '{$protocol}' type!", 1);
                    break;
            }

            if ($host) {
                $this->connections[$name]->header('Host', $host);
            }
        }

        return $this->connections[$name];
    }

    /**
     * 所有客户端
     * @return \Hprose\Http\Client[]|\Hprose\Socket\Client[]
     */
    public function connections()
    {
        return $this->connections;
    }

    /**
     * 创建 http 客户端
     * @param string $uri
     * @param bool $async
     * @return Hprose\Http\Client
     */
    public function createHttpClient(string $uri = '', bool $async = false)
    {
        return new \Hprose\Http\Client($uri, $async);
    }

    /**
     * 创建 socket 客户端
     * @param string $uri
     * @param bool $async
     * @return Hprose\Socket\Client
     */
    public function createSocketClient(string $uri = '', bool $async = false)
    {
        return new \Hprose\Socket\Client($uri, $async);
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
        return call_user_func_array([$this->connection(), $name], $args);
    }
}
