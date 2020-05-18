<?php

namespace Huangdijia\Hprose\Console;

use Huangdijia\Hprose\HproseServiceProvider;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature   = 'hprose:install';
    protected $description = 'Install all of the hprose';

    public function handle()
    {
        $this->info('Installing Package...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => HproseServiceProvider::class,
            '--tag'      => "config",
        ]);

        $this->info('Installed Package');
    }
}
