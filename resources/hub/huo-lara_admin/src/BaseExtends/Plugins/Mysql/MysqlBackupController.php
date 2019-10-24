<?php

namespace Huojunhao\LaraAdmin\BaseExtends\Plugins\Mysql;

use App\HttpAdmin\Controllers\Base\AdminBaseController;
use App\HttpAdmin\Extensions\TenancyException;
use Huojunhao\LaraAdmin\BaseExtends\Widgets\DoWithConfirm;
use Huojunhao\LaraAdmin\BaseExtends\Widgets\NormalLink;
use Huojunhao\LaraAdmin\Form;
use Huojunhao\LaraAdmin\Grid;
use Huojunhao\LaraAdmin\Grid\Displayers\Actions;
use Huojunhao\Lib\Database\MysqlMaintenance;
use Illuminate\Support\Facades\DB;

class MysqlBackupController extends AdminBaseController
{


    protected $title = '数据库管理';


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new MysqlBackup());

        $grid->column('name', __('Name'));
        $grid->column('size', __('Size'))->display(function($size){
            return $size . "M";
        });
        $grid->column('filemtime', __('Created at'));

        $grid->actions((function( Actions $action){
            $row = $action->row;
            $action->append(NormalLink::obj('下载',url('admin/mysqlBackup/download/'.$row->name))->blank());
            $action->append(DoWithConfirm::obj('恢复',url('admin/mysqlBackup/recover'),$row->name)->setMsg("此操作将丢失新增的生产数据，确定要恢复吗？")->isNormalLink());
            $action->append(DoWithConfirm::obj('删除',url('admin/mysqlBackup/del'),$row->name)->isNormalLink()->gridRowDelete());
            $action->disableDelete();
            $action->disableEdit();
            $action->disableView();
        }));
        $grid->tools(function (Grid\Tools $tools){

            $tools->append(  DoWithConfirm::obj("添加备份",url('admin/mysqlBackup/backup'))->setColorType('success'));
            $tools->append(NormalLink::obj('查看字典文档',url('admin/mysqlBackup/mysqlToHtml'))->blank()->isBtn()->setMarginX());

        });


        $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableRowSelector();
            $grid->disableFilter();

        return $grid;


    }


    /**
     * @param $name
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($name)
    {


        try{
            if (!$name) {
                throw new TenancyException("数据库名称不合法");
            }
            $full_name = MysqlMaintenance::obj()->getBackupPath() . "/" . $name;

            $this->actionLog("下载了数据库备份".$full_name);
            return response()->download($full_name);

        }catch (TenancyException $e){
            return back();

        };


    }



    public function recover()
    {
        $name = request("primary_key");
        try{
            if (!$name) {
                throw new TenancyException("数据库名称不合法");
            }
            $full_name = MysqlMaintenance::obj()->getBackupPath(). "/" . $name;

            $backup = new MysqlMaintenance();
            $backup->recover($full_name);

            $msg = "恢复了数据库备份：".$name;
            $this->actionLog($msg);
        }catch (TenancyException $e){
            return response()->json(["status" => 0,
                'message' =>[
                    'title' => $e->getMessage(),
                    'type'=> "error"
                ]
            ]);
        };

        return response()->json(["status" => 1,
            'message' =>[
                'title' => "恢复成功!",
                'type'=> "success"
            ]
        ]);

    }


    public function backup()
    {
        try{


            $dir = MysqlMaintenance::obj()->getBackupPath();

            if (!is_writable($dir)) {
                throw new TenancyException($dir . "没有写权限");
            }

            $backup = new MysqlMaintenance();
            $res = $backup->backup();

            $msg = "添加了数据库备份:".$res['name'];
            $this->actionLog($msg);
        }catch (TenancyException $e){
            return response()->json(["status" => 0,
                'message' =>[
                    'title' => $e->getMessage(),
                    'type'=> "error"
                ]
            ]);
        };

        return response()->json(["status" => 1,
            'message' =>[
                'title' => "添加成功!",
                'type'=> "success"
            ]
        ]);
    }


    public function del()
    {
        $name = request("primary_key");

        try{
            if (!$name) {
                throw new TenancyException("数据库名称不合法");
            }

            $full_name = MysqlMaintenance::obj()->getBackupPath(). "/" . $name;

            if (!is_writable($full_name)) {
                throw new TenancyException("没有写权限,需要在服务器上删除");

            }
            unlink($full_name);

            $msg = "删除了数据库备份:".$name;
            $this->actionLog($msg);

        }catch (TenancyException $e){
            return response()->json(["status" => 0,
                'message' =>[
                    'title' => $e->getMessage(),
                    'type'=> "error"
                ]
            ]);
        };

        return response()->json(["status" => 1,
            'message' =>[
                'title' => "删除成功!",
                'type'=> "success"
            ]
        ]);
    }



    /**
     *
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return null;
    }


    public function mysqlToHtml()
    {

        $mysql_conf = config("database.connections.mysql");
        $tables_info = DB::select("SHOW TABLE STATUS FROM " . $mysql_conf['database']);

        foreach ($tables_info as $item) {
            $all = DB::table($item->Name)->get();
            $str = $item->Name."    ";
            foreach ($all as $sub) {
                if (isset($sub->name)) {
                    $str .=  $sub->id.",".$sub->name.";";
                }
            }
            if ($all->isNotEmpty()) {
                if (request('show')) {
                    dump($str);
                }

            }
        }
//        die;


        $table_count = count($tables_info);
        $default_comments = $this->defaultTableComments();
        foreach ($tables_info as $i =>  $table) {
            $sql='show full fields from `' . $table->Name.'`';

            $tables_info[$i]->fields = DB::select($sql);

            if(in_array($table->Name,array_keys($default_comments))){
                foreach ($tables_info[$i]->fields as $key => $field) {
//                    dump($field);
//                    dump($default_comments[$table->Name]);
//                    dd($tables_info[$i]->fields[$key]->Comment );
                    $tables_info[$i]->fields[$key]->Comment = $default_comments[$table->Name][$field->Field];
                }
            }

            $sql="show keys from `".$table->Name.'`';

            $tables_info[$i]->keys = DB::select($sql);

        }

//        dump($tables_info);
        $data = [
            'mysql_conf' => $mysql_conf,
            'tables_info' => $tables_info,
            'table_count' => $table_count

        ];

//        dd($data);
        return view("admine::base.pieces.mysql_to_html",$data);


    }


    protected function defaultTableComments()
    {
        return [
            'admin_config' => [
                'id' => "主键ID",
                "name" => "配置名",
                "value" => "配置值",
                "description" =>"描述",
                "created_at" => "创建时间",
                "updated_at" => "更新时间"
            ],
            'migrations' => [
                'id' => "主键ID (本表是laravel自带，用于管理sql迁移,可忽略)",
                'migration' =>"执行的迁移文件",
                'batch' => "执行批次"
            ]

        ];

    }








}
