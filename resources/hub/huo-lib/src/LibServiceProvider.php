<?php

namespace Huojunhao\Lib;

use Illuminate\Support\ServiceProvider;

class LibServiceProvider extends ServiceProvider
{



    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // 注册publish
//            $this->publishes([__DIR__.'/../config' => config_path()], 'laravel-admin-config');
//
//            $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/laravel-admin')], 'laravel-admin-assets');
        }

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

//        dump('LibServiceProvider');

//        $this->commands($this->commands);
    }

}
