<?php

namespace Huojunhao\LaraAdminGenerator\HuoMake;

use Huojunhao\Generator\HuoMake\Utils\HuoMakeBase;
use Huojunhao\LaraAdminGenerator\HuoMake\Utils\HuoLaraAdminMakeBase;
use Illuminate\Support\Str;


class HuoMakeControllerCommand extends HuoLaraAdminMakeBase
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'hga:adminc {name} {--model=} {--title=} {--parent=} {--remove}    ';

    protected $model_prefix = "\\App\\Models\\";

    protected $stub_dir;
    protected $controller_stub_path = '';

    protected $des_dir;

    protected $controller_name = '';
    protected $model_name = "";

    protected $parent_controller = '';

    protected $model_obj = '';

    protected $router_path = "";

    protected $title = "自动生成后台管理";

    protected $module = "Admin";

    protected $snake_module = "";

    protected $browser_test_stub_path = "";

    protected $browser_base_test_stub_path = "";

    protected $browser_test_dest_dir;
    /**
     * @var array
     */
    protected $doctrineTypeMapping = [
        'string' => [
            'enum', 'geometry', 'geometrycollection', 'linestring',
            'polygon', 'multilinestring', 'multipoint', 'multipolygon',
            'point',
        ],
    ];

    protected $formats = [
        'form_field'  => "\$form->%s('%s', __('%s'))",
        'show_field'  => "\$show->field('%s', __('%s'))",
        'grid_column' => "\$grid->column('%s', __('%s'))",
        'test_form_field' => "->%s('%s', %s)"
    ];


    /**
     * @var array
     */
    protected $fieldTypeMapping = [
        'ip'       => 'ip',
        'email'    => 'email|mail',
        'password' => 'password|pwd',
        'url'      => 'url|link|src|href',
        'mobile'   => 'mobile|phone',
        'color'    => 'color|rgb',
        'image'    => 'image|img|avatar|pic|picture|cover',
        'file'     => 'file|attachment',
    ];


    protected function removedCallback()
    {

        $this->warn("1: 还需要手动将".$this->router_path."中的相关路由".$this->getRouteMethod()."删除");
        $this->warn("2: 如果需要删除" . $this->module . "BaseTraitTest" . '请手动删除');
        $this->info('删除完毕!');
    }

    /**
     *
     */
    protected function init_configs()
    {
//        $this->stub_dir =  __DIR__.'/stubs/make_controller/';
        $this->stub_dir = $this->getBaseStubDir().'/makeControllerStubs/';

        $this->des_dir = app_path("HttpAdmin/");
        $this->controller_stub_path = $this->stub_dir . 'controller.stub.php';
        $this->browser_test_stub_path = $this->stub_dir . 'browser_test.stub.php';
        $this->browser_base_test_stub_path = $this->stub_dir . 'browser_base_test.stub.php';
        $this->controller_name = $this->argument('name');
        $this->router_path = $this->des_dir . "routes/work_routes.php";

        $this->browser_test_dest_dir = base_path("tests/Browser/Traits");
        $this->snake_module = Str::snake($this->module);
        if ($this->parent_controller = $this->option('parent')) {
            $this->controller_stub_path = $this->stub_dir . 'extends_controller.stub.php';

            return;
        }

        $title = $this->option('title');
        $title && $this->title = $title;

        $this->model_name =  $this->option("model");
        !$this->model_name &&  $this->model_name = $this->controller_name;
        $this->model_name = $this->model_prefix . $this->model_name;

        //判断model 存在不存在
        if (!class_exists($this->model_name)) {
            $this->errorDie($this->model_name."模型不存在");
        }

        $this->model_obj = new $this->model_name();
    }


    protected function makeWithParent()
    {
        $full_controller_name = $this->controller_name . "Controller";

        $dummies = [
            "DummyController" => $full_controller_name,
            "DummyParentController" => $this->parent_controller."Controller",

        ];
        $this->quickTask($dummies, $this->getTasks());

        $this->makeSucceed();

    }
    /**
     * @throws \Exception
     */
    protected function makeCommand()
    {

        if (file_exists($this->getControllerPath())) {
            $this->errorDie($this->getControllerPath()."控制器已存在");
        }

        if ($this->parent_controller) {
            return $this->makeWithParent();
        }
//        $full_controller_name = $this->controller_name . "Controller";
        $dummies = [
//            "DummyController" => $full_controller_name,
            "DummySimpleName" => $this->controller_name,
            "DummyRouteName" => $this->getRouteMethod(),
            "DummyModelName" => $this->model_name,
            "//DummyGrid" => $this->getGrid(),
            "//DummyForm" => $this->getForm(),
            "//DummyShow" => $this->getShow(),
            "//TestForm" => $this->getTestForm(),
            "DummyTitle" => $this->title,
            "DummyModuleName" => $this->module,
            "DummySnakeModuleName" => $this->snake_module,
        ];
        $this->quickTask($dummies, $this->getTasks());

        $this->makeSucceed();

    }

    protected function makeSucceed()
    {
        $this->addRoute();
        $this->info("尝试访问以下链接 ");
        $this->info( config('app.url')."/$this->snake_module/".$this->getRouteMethod());
        $this->info("若要浏览器测试，需要确认：");
        $this->warn("1: ".$this->module."BaseTraitTest文件use了".$this->controller_name."Test");

        $this->warn("2: DevTest文件use 了".$this->module."BaseTraitTest");
        $this->info("最后执行以下命令进行测试 ");
        $this->warn("a dusk --filter=".$this->module.$this->controller_name);
    }

    protected function getRouteMethod()
    {
        return Str::plural(Str::snake($this->controller_name));
    }

    protected function addRoute()
    {
        $full_controller_name = $this->controller_name . "Controller";

        //在路由文件再加上这个资源路由
        $route_method = $this->getRouteMethod();
        $route_str = PHP_EOL."\$router->resource('$route_method', $full_controller_name::class);".PHP_EOL;
        //先判断是否已添加过，
        if (Str::contains(file_get_contents($this->router_path),$route_str)) {
            $this->warn("已添加过路由： ".$route_str);
            return ;
        }

        file_put_contents($this->router_path, $route_str,FILE_APPEND);
    }


    /**
     * @return string
     * @throws \Exception
     */
    protected function getGrid()
    {
        $output = '';

        foreach ($this->getTableColumns() as $column) {
            $name = $column->getName();
            $label = $this->formatLabel($name);

            $output .= sprintf($this->formats['grid_column'], $name, $label);
            $output .= ";\r\n";
        }

        return $output;
    }

    protected function getForm()
    {
        $reservedColumns = $this->getReservedColumns();

        $output = '';

        foreach ($this->getTableColumns() as $column) {
            $name = $column->getName();
            if (in_array($name, $reservedColumns)) {
                continue;
            }
            $type = $column->getType()->getName();
            $default = $column->getDefault();

            $defaultValue = '';

            // set column fieldType and defaultValue
            switch ($type) {
                case 'boolean':
                case 'bool':
                    $fieldType = 'switch';
                    break;
                case 'json':
                case 'array':
                case 'object':
                    $fieldType = 'text';
                    break;
                case 'string':
                    $fieldType = 'text';
                    foreach ($this->fieldTypeMapping as $type => $regex) {
                        if (preg_match("/^($regex)$/i", $name) !== 0) {
                            $fieldType = $type;
                            break;
                        }
                    }
                    $defaultValue = "'{$default}'";
                    break;
                case 'integer':
                case 'bigint':
                case 'smallint':
                case 'timestamp':
                    $fieldType = 'number';
                    break;
                case 'decimal':
                case 'float':
                case 'real':
                    $fieldType = 'decimal';
                    break;
                case 'datetime':
                    $fieldType = 'datetime';
                    $defaultValue = "date('Y-m-d H:i:s')";
                    break;
                case 'date':
                    $fieldType = 'date';
                    $defaultValue = "date('Y-m-d')";
                    break;
                case 'time':
                    $fieldType = 'time';
                    $defaultValue = "date('H:i:s')";
                    break;
                case 'text':
                case 'blob':
                    $fieldType = 'textarea';
                    break;
                default:
                    $fieldType = 'text';
                    $defaultValue = "'{$default}'";
            }

            $defaultValue = $defaultValue ?: $default;

            $label = $this->formatLabel($name);

            $output .= sprintf($this->formats['form_field'], $fieldType, $name, $label);

            if (trim($defaultValue, "'\"")) {
                $output .= "->default({$defaultValue})";
            }

            $output .= ";\r\n";
        }

        return $output;

    }


    protected function getTestForm()
    {

        $reservedColumns = $this->getReservedColumns();

        $output = '';

        foreach ($this->getTableColumns() as $column) {
            $name = $column->getName();
            if (in_array($name, $reservedColumns)) {
                continue;
            }
            $type = $column->getType()->getName();
            $default = $this->formatLabel($name);

            $fieldType = 'type';

            // set column fieldType and defaultValue
            switch ($type) {

                case 'datetime':
                    $defaultValue = "date('Y-m-d H:i:s')";
                    break;
                case 'date':
                    $defaultValue = "date('Y-m-d')";
                    break;
                case 'time':
                    $defaultValue = "date('H:i:s')";
                    break;
                default:
                    $defaultValue = "'{$default}'";
            }

            $output .= sprintf($this->formats['test_form_field'], $fieldType, $name, $defaultValue);

            $output .= "\r\n";
        }

        return $output;


    }

    protected function getShow()
    {
        $output = '';

        foreach ($this->getTableColumns() as $column) {
            $name = $column->getName();

            // set column label
            $label = $this->formatLabel($name);

            $output .= sprintf($this->formats['show_field'], $name, $label);

            $output .= ";\r\n";
        }

        return $output;

    }






    /**
     * Get columns of a giving model.
     *
     * @throws \Exception
     *
     * @return \Doctrine\DBAL\Schema\Column[]
     */
    protected function getTableColumns()
    {
        if (!$this->model_obj->getConnection()->isDoctrineAvailable()) {
            throw new \Exception(
                'You need to require doctrine/dbal: ~2.3 in your own composer.json to get database columns. '
            );
        }

        $table = $this->model_obj->getConnection()->getTablePrefix().$this->model_obj->getTable();
        /** @var \Doctrine\DBAL\Schema\MySqlSchemaManager $schema */
        $schema = $this->model_obj->getConnection()->getDoctrineSchemaManager($table);

        // custom mapping the types that doctrine/dbal does not support
        $databasePlatform = $schema->getDatabasePlatform();

        foreach ($this->doctrineTypeMapping as $doctrineType => $dbTypes) {
            foreach ($dbTypes as $dbType) {
                $databasePlatform->registerDoctrineTypeMapping($dbType, $doctrineType);
            }
        }

        $database = null;
        if (strpos($table, '.')) {
            list($database, $table) = explode('.', $table);
        }

        return $schema->listTableColumns($table, $database);
    }


    /**
     * Format label.
     *
     * @param string $value
     *
     * @return string
     */
    protected function formatLabel($value)
    {
        return ucfirst(str_replace(['-', '_'], ' ', $value));
    }


    protected function getTasks()
    {

        $tasks = [
            [
                'stub_path' => $this->controller_stub_path,
                'des_path' => $this->getControllerPath()
            ],
            [
                'stub_path' => $this->browser_test_stub_path,
                'des_path' => $this->browserTestPath()
            ],

        ];


        if (!file_exists($this->browserBaseTestPath())) {
            array_push($tasks,[
                'stub_path' => $this->browser_base_test_stub_path,
                'des_path' => $this->browserBaseTestPath()
            ]);
        }
        return $tasks;

    }

    protected function getControllerPath()
    {
        return $this->des_dir . "Controllers/" . $this->controller_name . "Controller.php";
    }


    protected function browserTestPath()
    {
        return $this->browser_test_dest_dir . "/".$this->module."/".$this->controller_name."TraitTest.php";
    }

    protected function browserBaseTestPath()
    {
        return $this->browser_test_dest_dir . "/".$this->module."/".$this->module."BaseTraitTest.php";

    }


    protected function getReservedColumns()
    {
        return [
            $this->model_obj->getKeyName(),
            $this->model_obj->getCreatedAtColumn(),
            $this->model_obj->getUpdatedAtColumn(),
            'deleted_at',
        ];
    }
}
