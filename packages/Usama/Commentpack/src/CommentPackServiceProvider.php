<?php

namespace Usama\CommentPack;

use Illuminate\Support\ServiceProvider;

class CommentPackServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        // including the routes of the package
        include __DIR__ . '/Http/routes.php';
        /*
         * Publishing files
         *
         * */

        /*$this->publishes([
            __DIR__.'/Config/CommentPack.php' => config_path('CommentPack.php'),
        ], 'config');*/

        /*
         * Load Translation
         * */
        $this->loadTranslationsFrom(__DIR__.'/Lang','CommentPack');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CommentPack', function ($app) {
            return new CommentPack();
        });
        /*
         * Declaring Config
         * */
        $this->mergeConfigFrom( __DIR__.'/Config/CommentPack.php', 'CommentPack');
        $this->loadViewsFrom(__DIR__.'/Views','CommentPack');

    }
}
