<?php

namespace App\HttpAdmin\Controllers\Base;


use Huojunhao\LaraAdmin\Layout\Content;

class TestController extends AdminBaseController
{
    public function modals(Content $content)
    {

        return $content->view("modals.modal_tests",[]);
    }

    public function modalHandle()
    {
        if(session('modal_test')){
            session(['modal_test' => false]);
            return response()->json(["status" => 1,
                'message' =>[
                    'title' => "测试成功",
                    'type'=> "success"
                ]
            ]);
        }else{
            session(['modal_test' => true]);
            return response()->json(["status" => 0,
                'message' =>[
                    'title' => "测试失败",
                    'type'=> "error"
                ]
            ]);
        }

    }

}
