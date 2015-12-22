<?php

namespace Usama\ModulePack;

use Illuminate\Support\ServiceProvider;

class ModulePackServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // to include files or publish files
        $this->publishes([
            __DIR__.'/Config/ModulePack.php' => config_path('ModulePack.php'),
        ], 'config');
        $this->publishes([__DIR__.'/Lang','ModulePack']);
        // include the routes.php
        include __DIR__.'/Http/routes.php';


        // for lang files
        $this->loadTranslationsFrom(__DIR__.'/Lang','ModulePack');
        $this->loadViewsFrom(__DIR__ . '/Views', 'ModulePack');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // bind the name of the Facade that will be used later
        $this->app->bind('ModulePack', function ($app) {
            return new ModulePack();
        });
        /*
         * public the config file
         * */
        // if you did not publish the config file within the boot then it will be only local to the package
        $this->mergeConfigFrom( __DIR__.'/Config/ModulePack.php', 'ModulePack');

    }
}
