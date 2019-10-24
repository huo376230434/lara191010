<?php

namespace Huojunhao\Generator\HuoMake;

use Huojunhao\Generator\HuoMake\Utils\HuoMakeBase;
use Illuminate\Support\Str;

class HuoMakeTest extends HuoMakeBase
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hg:test  {command_param} {--remove} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成';

    protected $stub_dir;

    protected $des_dir;
    protected $command_param;



    protected function init_configs()
    {
        $this->stub_dir = $this->getBaseStubDir().'/testStubs/';
        $this->des_dir = app_path();
        $this->command_param = $this->argument("command_param");
        if (!$this->command_param) {
            $this->error('command_param 必填');
            die;

        }
    }

    protected function makeCommand()
    {
        $dummies = [
            "test" => Str::snake($this->command_param),
            "Test" => $this->command_param
        ];
        $this->quickTask($dummies, $this->getTasks());
    }



    protected function getTasks()
    {
        $tasks = [
            [
                'stub_path' => $this->stub_dir . 'test.stub.php',
                'des_path' => $this->des_dir  . $this->command_param . ".php"
            ]
        ];
        return $tasks;

    }



}
