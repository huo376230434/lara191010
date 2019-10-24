<?php

namespace Huojunhao\LaraAdminGenerator\HuoMake;

use Huojunhao\LaraAdminGenerator\HuoMake\Utils\HuoLaraAdminMakeBase;
use Illuminate\Support\Str;

class HuoMakeArea extends HuoLaraAdminMakeBase
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hga:area  {--model=} {--remove} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成';

    protected $stub_dir;

    protected $des_dir;

    protected $model="SysArea";


    protected function init_configs()
    {
        $this->stub_dir = $this->getBaseStubDir().'/areaStubs/';

        $model = $this->option('model');
        $model && $this->model = $model;
    }


    protected function removedCallback()
    {
        parent::removedCallback(); //
//        $this->warn("迁移文件 需要手动移除,并确认迁移是否已经回滚 rollback");
        $this->warnHandRemoveMigrate();

    }

    protected function makeCommand()
    {
        if ($this->migrationIsExist($this->getTableName())) {
            $this->errorDie($this->getTableName()."迁移文件已经存在");
        }

        $dummies = [
            "DummyAreaTable" => $this->getTableByModel(),
            "DummySysArea" => $this->model,
            "DummyPluralSysArea" => Str::plural($this->model)
        ];

        $this->quickTask($dummies, $this->getTasks());

        $this->successCallback();
    }

    protected function successCallback()
    {

        $this->warn("需要执行以下迁移命令");
        $this->info("a migrate --seed");
        $this->warn("再执行单元测试");
        $this->info("pu --filter=Plugins.*" . $this->model."Test");

    }



    protected function getTasks()
    {
        $tasks = [
            [
                'stub_path' => $this->stub_dir . 'area_data',
                'des_path' => database_path("seeds/area_data")
            ],
            [
                'stub_path' => $this->stub_dir . 'area_seeder.stub.php',
                'des_path' => database_path('seeds/InitAreaSeeder.php')
            ],
            [
                'stub_path' => $this->stub_dir . 'model.stub.php',
                'des_path' => $this->model_dir.$this->model.".php"
            ],
            [
                'stub_path' => $this->stub_dir . 'unittest.stub.php',
                'des_path' => base_path('tests/Unit/Plugins/'.$this->model."Test.php")
            ],
            [
                'stub_path' => $this->stub_dir . "area_migrate.stub.php",
                'des_path' => database_path('migrations/'.date('Y_m_d_His').$this->getTableName())
            ]
        ];

        return $tasks;

    }

    protected function getTableName()

    {

        return "_create_" . $this->getTableByModel() . "_table.php";
    }



}
