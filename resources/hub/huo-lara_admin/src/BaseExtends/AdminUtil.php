<?php

namespace Huojunhao\LaraAdmin\BaseExtends;



use Huojunhao\LaraAdmin\Facades\Admin;
use Huojunhao\LaraAdmin\Form;
use Huojunhao\LaraAdmin\Grid;

class AdminUtil
{


    /**
     * @throws \Throwable
     */
    public static function defaultBootstrap()
    {

        Grid::init(function (Grid $grid) {

            $grid->disableColumnSelector();
        });


        Form::init(function (Form $form) {

            $form->disableEditingCheck();
//
            $form->disableCreatingCheck();
//
            $form->disableViewCheck();

            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
                $tools->disableView();
                $tools->disableList();
            });
        });

        Admin::js(asset('/js/third/loadsh.min.js'));
        Admin::js(asset('/js/third/vue.min.js'));
        Admin::js(asset('/js/base.js'));

    }
//
//
//
//    public static function successReturn($msg = "成功",$redirect_url=null)
//    {
////        AdminUtil::onceToastr($msg);
////        static::onceToastr($msg);
//        if ($redirect_url) {
//            return redirect($redirect_url);
//
//        }else{
//            return back();
//
//        }
//
//    }
////
////    public static function currentMenuUri()
////    {
////
////        $request = request();
////        [$prefix, $uri] = array_pad(explode('/', $request->path()),2,null);
////
////        return $uri ? : '/';
////
////    }
//
//
//
//
//
//
//    public static function gridId(Grid $grid,&$grid_id = null)
//    {
//        if (is_null($grid_id)) {
//            static $grid_id = 1;
//        }
////        $grid->id('ID')->sortable();
//
//
//        $grid->column('show_id', '序号')->display(function ($value) use(&$grid_id) {
//
//            $temp =$grid_id;
//            $grid_id++;
//            return $temp;
////            dd(get_class($this));
//        });
//
//    }
//
//
//    public static function DefaultFormOptimize( $form)
//    {
//
//        $form->tools(function (Form\Tools$tools) {
//
//            // 去掉`删除`按钮
//            $tools->disableDelete();
//
//            // 去掉`查看`按钮
//            $tools->disableView();
//            $tools->disableList();
//
//        });
//
//
//
//        $form->footer(function (Form\Footer $footer) {
//            // 去掉`重置`按钮
//            $footer->disableReset();
//
//            // 去掉`查看`checkbox
//            $footer->disableViewCheck();
//
//            // 去掉`继续编辑`checkbox
//            $footer->disableEditingCheck();
//
//            // 去掉`继续创建`checkbox
//            $footer->disableCreatingCheck();
//
//        });
//    }
//
//
//    /**
//     * @throws \App\Admin\Extensions\AdminException
//     */
//    public static function requestToBatch($id=null)
//    {
//      !$id &&  $id = request("primary_key");
//        $ids = request('ids');
//        if (!$id && !$ids) {
//            throw new AdminException("请至少选择一项");
//
//        }
//        if ($id) {
//            $ids = [$id];
//        }
//        if (is_string($ids)) {
//            $ids = [$ids];
//        }
//        return $ids;
//
//    }
////
//
//    public static function areaform(Form $form,$edit_obj)
//    {
//        $area_all_ids = [];
//        if(!empty($edit_obj->sysArea)){
//            $area_all_ids = $edit_obj->sysArea->allIds();
//        }
//
//        $form->html(areaFormView(false, $area_all_ids),"地区");
////            ->required();
//
//    }
//
//
//
//
//    public static function areaFormSaving(Form $form )
//    {
//
//
//        //没有城市ID，则取省 id
//        $form->sys_area_id = static::requestAreaId();
//        logger($form->sys_area_id);
//        logger(request()->all());
//    }
//



}
