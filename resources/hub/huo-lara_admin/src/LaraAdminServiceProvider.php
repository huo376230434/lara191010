<?php

namespace Huojunhao\LaraAdmin;

use Huojunhao\LaraAdmin\BaseExtends\Plugins\Config\ConfigModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class LaraAdminServiceProvider extends ServiceProvider
{



    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'admine');

        $table = ConfigModel::configTable();

        if (Schema::hasTable($table)) {
            ConfigModel::loadConfigs();
        }
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

//        dump('LaraAdminServiceProvider');

//        $this->commands($this->commands);
    }

}
