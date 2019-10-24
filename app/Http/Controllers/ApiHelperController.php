<?php

namespace App\Http\Controllers;

use Huojunhao\LaraAdmin\BaseExtends\LogicTraits\Admin\ApiHelperTrait;
use Illuminate\Http\Request;

class ApiHelperController extends Controller
{
    //
    use ApiHelperTrait;

    //允许的model 开发时可以不写，生产时一定要控制
    protected function allowedModels()
    {
//        dd("apihttphelper");
        return [
//            [  "BaseModel","testVisitView"]
        ];
    }
}
