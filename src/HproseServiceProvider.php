<?php

namespace Huangdijia\Hprose;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class HproseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadRoutesFrom($this->app->basePath('routes/hprose.php'));
        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('hprose.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../routes/hprose.php' => $this->app->basePath('routes/hprose.php'),
            ], 'routes');

            // Registering package commands.
            $this->commands([
                Console\StartCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        if (is_file(__DIR__ . '/../config/config.php')) {
            $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'hprose');
        }

        // Register the main class to use with the facade
        $this->app->singleton('hprose.router', function ($app) {
            return new Routing\Router($app);
        });
        $this->app->singleton('hprose.server', function ($app) {
            return new Manager($app);
        });
        $this->app->singleton('hprose.client', function ($app) {
            return new Client($app);
        });
    }

    /**
     * Register the router for http mode
     */
    public function registerRoutes()
    {
        Route::any($this->app['config']->get('hprose.server.modes.http.path', 'hprose'), function () {
            Facades\Server::server('http')->setRouter(Facades\Route::getRouter())->start();
        });
    }
}
