<?php

namespace Huojunhao\LaraAdminGenerator\HuoMake;

use Huojunhao\LaraAdminGenerator\HuoMake\Utils\HuoLaraAdminMakeBase;
use Illuminate\Support\Str;

class HuoMakeOperFlow extends HuoLaraAdminMakeBase
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hga:oper_flow  {--module=} {--model=} {--user=} {--remove} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成';

    protected $stub_dir;

    protected $command_param;

    protected $module="Admin";
    protected $model="OperateFlow";
    protected $user="Base\\AdminUser";


    protected function init_configs()
    {
        if ($module = $this->option('module')) {
            $this->module = $module;
        }
        if ($model = $this->option('model')) {
            $this->model = $model;
        }

        if ($user = $this->option('user')) {
            $this->user = $user;
        }
        $this->stub_dir = $this->getBaseStubDir().'/oper_flowStubs/';

    }

    protected function removedCallback()
    {
        $this->info('删除完毕!');
        $this->warnHandRemoveMigrate();
        $this->warnHandRemoveRoute();
    }


    protected function makeCommand()
    {

        $model_path = $this->model_dir . $this->model . ".php";
        if (file_exists($model_path)) {
            $this->errorDie($model_path."已存在，确认是否生成过");

        }

        $user_model = explode('\\', $this->user);
        $user_model = end($user_model);
        $dummies = [
            "DummyTable" => $this->getTableByModel($this->model),
            "DummyModel" => $this->model,
            "DummyModule" => $this->module,
            "DummycamelUserModel" => ucwords($user_model),
            "DummySnakeUserModel" => Str::snake($user_model),
            "DummyUserModel" => $this->user,
            "DummyPluralModel" => Str::plural($this->model)
        ];
        $this->quickTask($dummies, $this->getTasks());
        $this->makeSucceed();

    }

    protected function makeSucceed()
    {
        $this->addRoute();
        $this->info("尝试访问以下链接 ");
        $this->info( config('app.url')."/".Str::snake($this->module)."/".$this->getTableByModel($this->model));
        $this->info("若要浏览器测试，需要确认：");
        $this->warn("1: ".$this->module."BaseTraitTest文件use了".$this->model."Test");

        $this->warn("2: DevTest文件use 了".$this->module."BaseTraitTest");
        $this->info("最后执行以下命令进行测试 ");
        $this->warn("a dusk --filter=".$this->module.$this->model);

        $this->info("若要单元测试，执行以下命令");
        $this->warn("pu --filter=".$this->model."Test");
    }


    protected function addRoute()
    {
        $full_controller_name = $this->model . "Controller";

        //在路由文件再加上这个资源路由
        $route_method = $this->getTableByModel($this->model);
        $route_str = PHP_EOL."\$router->resource('$route_method', $full_controller_name::class);".PHP_EOL;
        //先判断是否已添加过，
        if (Str::contains(file_get_contents($this->getRoutePath()),$route_str)) {
            $this->warn("已添加过路由： ".$route_str);
            return ;
        }

        file_put_contents($this->getRoutePath(), $route_str,FILE_APPEND);
    }



    protected function getTasks()
    {
        $model_path = $this->model_dir . $this->model . ".php";

        $tasks = [
            [
                'stub_path' => $this->stub_dir . 'browser_test_trait.stub.php',
                'des_path' => $this->browser_test_dir  . "Traits/".$this->module."/" .$this->model."TraitTest". ".php"
            ],
            [
                'stub_path' => $this->stub_dir."controller.stub.php",
                "des_path" => app_path("Http".$this->module."/Controllers/".$this->model."Controller.php")
            ],
            [
                'stub_path' => $this->stub_dir."model.stub.php",
                'des_path' => $model_path
            ],
            [
                'stub_path' => $this->stub_dir."operate_flows_table_migrate.stub.php",
                'des_path' => database_path('migrations/'.date("Y_m_d_His")."_create_".$this->getTableByModel($this->model)."_table.php")
            ],
            [
                'stub_path' => $this->stub_dir . "unit_test.stub.php",
                'des_path' => $this->unit_test_dir."Plugins/".$this->model."Test.php"
            ]
        ];
        return $tasks;

    }



}
