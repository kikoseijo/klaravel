<?php

namespace Ksoft\Klaravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Route;
use Ksoft\Klaravel\Console\Commands\MakeKrud;
use Ksoft\Klaravel\Console\Commands\BuildSwagger;
use Ksoft\Klaravel\Console\Commands\PublishConfig;
use Illuminate\Support\Facades\Blade;


class ServiceProvider extends BaseServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->defineRoutes();
        $this->registerViews();
        $this->registerComponents();
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

    protected function defineRoutes()
    {
        // If the routes have not been cached, we will include them in a route group
        // so that all of the routes will be conveniently registered to the given
        // controller namespace. After that we will load the route file.
        if (! $this->app->routesAreCached()) {
            Route::group([
                'namespace' => 'Ksoft\Klaravel\Http\Controllers'],
                function ($router) {
                    require __DIR__.'/Http/routes.php';
                }
            );
        }
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources', 'klaravel');
        $this->publishes([
            __DIR__.'/../resources' => resource_path('views/vendor/klaravel'),
        ]);
        $this->publishes([
            __DIR__.'/../stubs/config/ksoft.php' => config_path('ksoft.php'),
        ], 'config');
    }

    protected function registerComponents()
    {
        if (!Larapp::isLumen()) {
            Blade::component('klaravel::ui.card', 'card');
        }
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
