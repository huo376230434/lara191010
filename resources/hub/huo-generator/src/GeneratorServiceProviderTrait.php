<?php

namespace Huojunhao\Generator;

use Huojunhao\Lib\Base\FileUtil;
use Illuminate\Support\Str;

trait GeneratorServiceProviderTrait
{



    protected function getCommands()
    {
        $this->generator_dir = $this->getGeneratorDir();
        $make_commands = FileUtil::allFile($this->generator_dir);
//        dump($this->generator_dir);
        $make_commands = $this->filtCommands($make_commands);

        return $make_commands;

    }

    protected function getGeneratorDir()
    {
        return __DIR__ . '/HuoMake/';
    }

    protected function filtCommands($commands)
    {
//        dump($commands);
        $commands = collect($commands)
            ->filter(function($value,$key){
                return Str::endsWith( $value,".php");
            })
            ->map(function ($value,$key){
                return  substr($value,0,strrpos($value,'.php'));
            })
            ->filter(function ($value,$key){
                return class_exists($this->namespace_prefix . $value);
            })->map(function ($value,$key){
                return $this->namespace_prefix . $value;
            })->toArray();

        return $commands;
    }


}
