<?php
namespace Huojunhao\LaraAdmin;

use Illuminate\Support\Facades\Facade;

/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019/2/11
 * Time: 下午2:31
 */
class CusAdmin extends Facade {


    protected static function getFacadeAccessor()
    {
        return ChildAdmin::class;
    }

}
