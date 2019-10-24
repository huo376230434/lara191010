<?php

namespace Huojunhao\Generator;

use Huojunhao\Lib\Base\FileUtil;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class GeneratorServiceProvider extends ServiceProvider
{
    use GeneratorServiceProviderTrait;
    protected $namespace_prefix = "Huojunhao\Generator\HuoMake\\";

    protected $generator_dir = "";



    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            // 注册publish
            $this->publishes([__DIR__.'/../resources/quickdev' => resource_path()], 'quickdev');
            $this->publishes([__DIR__.'/../resources/Models' => app_path()], 'models');
//
        }

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->getCommands() as $command) {
            $this->commands($command);

        }
    }


}
