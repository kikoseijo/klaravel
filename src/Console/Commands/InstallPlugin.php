<?php

namespace Ksoft\Klaravel\Console\Commands;

use Illuminate\Console\Command;
use Ksoft\Klaravel\Utils\InstPlugins;

class InstallPlugin extends Command
{
    protected $signature = 'ksoft:plugin {name}';

    protected $description = 'Install Plugin: (medialibrary)';

    public function handle()
    {
        $plugin_name = $this->argument('name');
        $script_name = array_get(InstPlugins::$plugins, $plugin_name);
        if ($this->laravel->runningInConsole()) {
            $script = KLARAVEL_PATH .'/src/Console/plugins/composer_install.sh '.$script_name['composer'];
            $this->info(shell_exec('sh '.$script));
        } else {
            $script = KLARAVEL_PATH ."/src/Console/plugins/composer_install.sh spatie/laravel-medialibrary:^6.0.0";
            $res = exec("cd .. && sh ${script}");

            // $command = 'cd .. && composer require spatie/laravel-medialibrary:^6.0.0';
            // $command = 'cd .. && pwd && composer require ' . $script_name['composer'] .' --no-scripts';
            // $res = exec($command);
            // $this->info(exec($composer_path . ' dump-autoload'));
            // logi($command);
            logi($res);
            return $res;
        }

    }
}
