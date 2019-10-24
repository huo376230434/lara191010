<?php

namespace Huojunhao\LaraAdminGenerator;

use Huojunhao\Generator\GeneratorServiceProviderTrait;
use Huojunhao\LaraAdminGenerator\HuoMake\HuoMakeControllerCommand;
use Huojunhao\Lib\Base\FileUtil;
use Illuminate\Support\ServiceProvider;

class LaraAdminGeneratorServiceProvider extends ServiceProvider
{
    use GeneratorServiceProviderTrait;

    protected $generator_dir = "";
    protected $namespace_prefix = "Huojunhao\LaraAdminGenerator\HuoMake\\";


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


    protected function getGeneratorDir()
    {
        return __DIR__ . '/HuoMake/';
    }



    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
//        dd($this->getCommands());
        foreach ($this->getCommands() as $command) {
            $this->commands($command);
        }
    }

}
