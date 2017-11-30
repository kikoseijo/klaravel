<?php

namespace Ksoft\Klaravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Intervention\Image\ImageManager;
use Ksoft\Klaravel\Console\Commands\MakeKrud;
use Ksoft\Klaravel\Console\Commands\BuildSwagger;
use Ksoft\Klaravel\Console\Commands\PublishConfig;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (!defined('KLARAVEL_PATH')) {
            define('KLARAVEL_PATH', realpath(__DIR__.'/../'));
        }

        $configPath = KLARAVEL_PATH.'/stubs/config/ksoft.php';
        $this->mergeConfigFrom($configPath, 'ksoft');

        $this->registerServices();
        $this->registerCommands();
    }


    /**
     * Register commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if (config('ksoft.runtime_console') || $this->app->runningInConsole()) {
            $this->commands([
                MakeKrud::class,
                BuildSwagger::class,
                PublishConfig::class,
            ]);
        }
    }


    /**
     * Register services.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->registerInterventionService();

        $services = [
            'Contracts\EloquentRepo' => 'Repositories\EloquentRepo',
        ];

        foreach ($services as $key => $value) {
            $this->app->singleton('Ksoft\Klaravel\\'.$key, 'Ksoft\Klaravel\\'.$value);
        }
    }

    /**
     * Register the Intervention image manager binding.
     *
     * @return void
     */
    protected function registerInterventionService()
    {
        $this->app->bind(ImageManager::class, function () {
            return new ImageManager(['driver' => 'gd']);
        });
    }

}
