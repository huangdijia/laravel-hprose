<?php

namespace Huangdijia\Hprose\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'Huangdijia\Hprose\HproseServiceProvider',
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'HproseClient' => 'Huangdijia\Hprose\Facades\Client',
            'HproseServer' => 'Huangdijia\Hprose\Facades\Server',
            'HproseRoute'  => 'Huangdijia\Hprose\Facades\Route',
        ];
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Your code here
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        // $app['config']->set('database.default', 'testbench');
        // $app['config']->set('database.connections.testbench', [
        //     'driver'   => 'sqlite',
        //     'database' => ':memory:',
        //     'prefix'   => '',
        // ]);
    }
}
