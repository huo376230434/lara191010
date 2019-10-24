<?php
namespace Huojunhao\Generator\HuoMake\Utils;

use Huojunhao\Lib\Base\FileUtil;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 18:44
 */
abstract  class HuoMakeBase extends Command{
    use HuoMakeTrait;

    protected $template_words=[];
    protected $replace_words=[];

    protected $model_dir;
    protected $migration_dir;

    protected $model_prefix = "\\App\\Models\\";
    protected $remove;


    protected $module;

    protected $model;
    protected $browser_test_dir;
    protected $unit_test_dir;
    protected $feature_test_dir;
    public function __construct()
    {
        parent::__construct();
        $this->model_dir = app_path("Models/");
        $this->browser_test_dir = base_path("tests/Browser/");
        $this->unit_test_dir = base_path("tests/Unit/");
        $this->feature_test_dir = base_path('tests/Feature/');
        $this->migration_dir = database_path('migrations/');
    }

    protected function getModelArr()
    {
        $models = FileUtil::allFileWithoutDir($this->model_dir);
        return collect($models)->reject((function ($value,$key){
            return Str::startsWith($value,'ZZ');
        }))->map(function($value,$key){
            return substr($value,0,-4);
        })->toArray();
    }

    protected function getRoutePath()
    {
        return app_path("Http" . $this->module . "/routes/work_routes.php");
    }



    protected function removePrefix()
    {

}


    protected function getTableByModel($model = null)
    {
        is_null($model ) && $model = $this->model;
        return Str::plural(Str::snake($model));

}

    protected function handleRemove()
    {
        $this->removePrefix();
        $this->quickRemove($this->getTasks());
        $this->removedCallback();
    }




    protected function errorDie($msg)
    {
        $this->error($msg);
        die;
    }

    protected function removedCallback()
    {
        $this->info('删除完毕!');
    }

    public function handle()
    {
        $this->remove = $this->option('remove');
        $this->init_configs();//初始化配置项
        if ($this->remove) {
            $this->handleRemove();
            return ;
        }
        $this->makeCommand();
    }

    public function migrationIsExist($str)
    {

        $files = FileUtil::allFile($this->migration_dir);
        $r = collect($files)->some(function($value)use ($str){
            return Str::contains($value, $str);
        });
        return $r;

    }


    public function warnHandRemoveMigrate()
    {
        $this->warn("迁移文件 需要手动移除,并确认迁移是否已经回滚 rollback");

    }

    public function warnHandRemoveRoute()
    {
        $this->warn("路由  需要手动移除");

    }

    abstract protected function makeCommand();

    abstract protected function init_configs();

    abstract protected function getTasks();




}
