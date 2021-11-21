<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Переопределяем класс пакета
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        $loader->alias('ReCaptcha\RequestMethod\Post', 'App\ReCaptcha\RequestMethod\Post');

        // if ($this->app->environment('local')) {
        //   $this->app->register('JeroenG\Packager\PackagerServiceProvider');
        // }
    }
}
