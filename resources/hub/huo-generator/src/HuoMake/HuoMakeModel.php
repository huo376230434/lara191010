<?php

namespace Huojunhao\Generator\HuoMake;

use Huojunhao\Lib\Base\FileUtil;
use Huojunhao\Generator\HuoMake\Utils\HuoMakeBase;
use Illuminate\Support\Str;

class HuoMakeModel extends HuoMakeBase
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hg:model  {model} {--m} {--fields=} {--remove} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成模型的方法';

    protected $stub_dir;

    protected $base_namespace = "App\Models\\";
    protected $model_name;
    protected $model = "";
    protected $migration_type;


    protected function init_configs()
    {
        $this->model = $this->argument("model");

        $this->stub_dir = $this->getBaseStubDir().'/modelsStubs/';

        $this->model_dir = app_path("Models/");
        $temp = explode("-",  $this->model);
        $this->model_name = $model_name = $temp[0];
        $this->migration_type = $temp[1] ?? null;

    }

    protected function makeCommand()
    {

        $model_name = ucfirst($this->model_name);

//        dd($this->getModelArr());
        if (!in_array($model_name, $this->getModelArr())) {
            $this->makeModelFile($model_name);
        }

        if ($this->option("m")) {
            //要生成迁移文件
            $this->makeMigration($model_name,$this->migration_type);
        }

    }

    protected function handleRemove()
    {
        parent::handleRemove(); // TODO: Change the autogenerated stub
        $remove_migrate_shell = $this->getShell(ucfirst($this->model_name)) . ' --remove';
        $this->info(shell_exec($remove_migrate_shell));
    }


    protected function getTasks()
    {
        $tasks = [
            [
                'stub_path' =>$this->stub_dir.'model.stub.php',
                'des_path' => $this->model_dir.$this->model_name.".php"],//
            [
                'stub_path' =>$this->stub_dir.'model_relation_trait.stub.php',
                'des_path' => $this->model_dir.'/ExtraModelTraits/'.$this->model_name."RelationTrait.php"],//
            [
                'stub_path' =>$this->stub_dir.'model_static_trait.stub.php',
                'des_path' => $this->model_dir.'/ExtraModelTraits/'.$this->model_name."StaticTrait.php"],//
        ];
        return $tasks;

    }







    protected function makeMigration($model_name,$migrate_type)
    {

        $this->info( shell_exec($this->getShell($model_name)));
    }

    protected function getShell($model_name)
    {
        $shell = " php  ".base_path('artisan').' hg:migration '.Str::plural(Str::snake($model_name));
        if ($fields = $this->option("fields")) {
            $shell .= ' --fields=' . $fields;
        }
        return $shell;
    }


    protected function makeModelFile($model_name)
    {
//生成model主文件
        $dummies = [
            "DummyModel" => $model_name
        ];

        $this->quickTask($dummies, $this->getTasks());




    }

}
