<?php

namespace Huojunhao\LibDev;

use Huojunhao\LibDev\Console\HuoQuickPushHub;
use Huojunhao\LibDev\Console\HuoSeed;
use Illuminate\Support\ServiceProvider;

class LibDevServiceProvider extends ServiceProvider
{

    protected $commands = [
       HuoSeed::class,
        HuoQuickPushHub::class
    ];

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
        $this->commands($this->commands);

//        dump('LibDevServiceProvider');

//        $this->commands($this->commands);
    }

}
