<?php

namespace Huangdijia\Hprose\Console;

use Huangdijia\Hprose\Facades\Route;
use Huangdijia\Hprose\Facades\Server;
use Illuminate\Console\Command;

class StartCommand extends Command
{
    protected $signature   = 'hprose:start';
    protected $description = 'Start a hprose service';

    public function handle()
    {
        Server::server('socket')
            ->setRouter(Route::getRouter())
            ->start();
    }
}
