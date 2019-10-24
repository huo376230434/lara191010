<?php

namespace Huojunhao\LaraAdminGenerator\HuoMake;

use Huojunhao\LaraAdminGenerator\HuoMake\Utils\HuoLaraAdminMakeBase;
use Huojunhao\Lib\Base\FileUtil;
use Illuminate\Support\Str;

class HuoMakeModule extends HuoLaraAdminMakeBase
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hga:module  {module_name?} {--api=} {--remove} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成';

    protected $stub_dir;

    protected $des_dir;
    protected $module_name = "Tenancy";

    protected $temp_stub_dir;


    protected function init_configs()
    {
        $this->stub_dir = $this->getBaseStubDir().'/moduleStubs/';
       $module_name = $this->argument("module_name");
        if ($module_name &&  $module_name!=$this->module_name) {
          // 此时为非默认模块，则需要将stub全部转为临时文件
            $this->module_name = $module_name;
            $this->moveStub();
        }
    }

    protected function removedCallback()
    {
        parent::removedCallback();
        $this->warnHandRemoveMigrate();
        $this->providerConfig(false);
    }


    protected function moveStub()
    {
        $this->temp_stub_dir = $this->getBaseStubDir()."/temp" . $this->module_name . "Stub/";
//        die;
        $this->rmTempStubDir();
        FileUtil::copyDir($this->stub_dir, $this->temp_stub_dir);
        //再把所有的文件中包含Tenancy的全替换掉
        $all_files = FileUtil::allFile($this->temp_stub_dir,true);
        foreach ($all_files as $file) {
            $new_file = str_replace(['tenancy','Tenancy'],[Str::snake($this->module_name),$this->module_name],$file);
            if ($new_file != $file) {
                //文件不一致，则移动替换
                FileUtil::moveFile($this->temp_stub_dir . $file, $this->temp_stub_dir . $new_file);
            }
//            dump($new_file);
        }
//        dd($all_files);

    }

    protected function rmTempStubDir()
    {
        is_dir($this->temp_stub_dir) && FileUtil::rmDir($this->temp_stub_dir);

    }

    protected function makeCommand()
    {
        if(is_dir(app_path('Http'.$this->module_name))){
            $this->rmTempStubDir();
            $this->errorDie($this->module_name."模块已存在");
        }
        $dummies = [];
        if ($this->temp_stub_dir) {
            $dummies = [
                "tenancy" => Str::snake($this->module_name),
                "Tenancy" => $this->module_name
            ];
        }

        $this->quickTask($dummies, $this->getTasks());

        $this->rmTempStubDir();

        $this->successMake();
    }

    protected function providerConfig($is_add=true)
    {
        $str = "删除";
        $is_add && $str = "添加";
        $this->info("先在配置文件app的 providers $str ：");
        $this->warn("\App\Providers\\".$this->module_name."ServiceProvider::class");

        $this->info("在配置文件app的 aliases $str ：");
        $this->warn("'{$this->module_name}' => \App\Http{$this->module_name}\Facades\\".$this->module_name."::class");

    }

    protected function successMake()
    {
        $this->composerDumpAutoload();
        $this->providerConfig();
        $this->info("需要先执行迁移命令");
        $this->warn("a migrate --seed");
        $this->info("进行浏览器测试，确认DevTest中有" . $this->module_name . "BaseTraitTest");
        $this->warn('a dusk --filter=' . $this->module_name);
    }



    protected function getTasks()
    {
        $stub_dir = $this->temp_stub_dir ?: $this->stub_dir;
        $tasks = [
            [
                'stub_path' => $stub_dir . 'browser_test',
                'des_path' => base_path("tests/Browser/Traits/".$this->module_name)
            ],
            [
                'stub_path' => $stub_dir . 'http_' . Str::snake($this->module_name),
                'des_path' => app_path('Http'.$this->module_name)
            ],
            [
                'stub_path' => $stub_dir.Str::snake($this->module_name)."_view",
                'des_path' => resource_path('views/' . Str::snake($this->module_name)),

            ],
            [
                'stub_path' => $stub_dir.'config_'.Str::snake($this->module_name).'.stub.php',
                'des_path' => config_path(Str::snake($this->module_name)).".php"
            ],
            [
                'stub_path' => $stub_dir . 'migrate_' . Str::snake($this->module_name).".stub.php",
                'des_path' => $this->migration_dir . date("Y_m_d_His") . "_create_" . Str::snake($this->module_name) . "_tables.php"

            ],
            [
                'stub_path' => $stub_dir . 'seeder.stub.php',
                'des_path' => database_path("seeds/Init".$this->module_name."Seeder.php")
            ],
            [
                'stub_path' => $stub_dir . "provider.stub.php",
                'des_path' => app_path("Providers/".$this->module_name."ServiceProvider.php")
            ],
            [
                'stub_path' => $stub_dir."model_user.stub.php",
                'des_path' => $this->model_dir."Base/".$this->module_name."User.php"
            ]
        ];
        return $tasks;

    }


//
//    protected function genDirMap()
//    {
//        $this->dir_map = [
//            $this->stub_dir . "Tenancy" => app_path("Tenancy"),
//            $this->stub_dir . "tenancy.php" => config_path("tenancy.php"),
//            $this->stub_dir."TenancyServiceProvider.php" => app_path("Providers/TenancyServiceProvider.php"),
//            $this->stub_dir . "tenancyview" => resource_path("views/tenancy"),
//            $this->stub_dir."create_tenancy_tables.php" => database_path("migrations")."/2016_01_05_115422_create_tenancy_tables.php",
//            $this->stub_dir."InitTenancySeeder.php" => database_path("seeds")."/InitTenancySeeder.php",
//            $this->stub_dir."TenancyNotification" => app_path('Notifications/Tenancy')
//
//        ];
//
//
//        $models = FileUtil::allFile($this->stub_dir . "model/");
////        dump($models);
//        foreach ($models as $model) {
//            $this->dir_map[$this->stub_dir . "model/". $model] = app_path("model/") . $model;
//        }
////        dump($this->dir_map);
//
//
//
//    }




}
