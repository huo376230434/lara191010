<?php

namespace App\HttpTenancy\Controllers;

use App\HttpTenancy\Controllers\Base\TenancyBaseController;
use Huojunhao\LaraAdmin\BaseExtends\LogicTraits\Admin\AdminUserTrait;


class TenancyUserController extends TenancyBaseController
{
    use AdminUserTrait;

    protected function moduleSnake()
    {
        return "tenancy";
    }
}
