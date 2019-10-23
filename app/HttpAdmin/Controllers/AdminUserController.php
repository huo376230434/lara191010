<?php

namespace App\HttpAdmin\Controllers;

use App\HttpAdmin\Controllers\Base\AdminBaseController;
use App\HttpAdmin\Exporters\AdminUserExporter;
use Huojunhao\LaraAdmin\BaseExtends\LogicTraits\Admin\AdminUserTrait;
use Huojunhao\LaraAdmin\Form;
use Huojunhao\LaraAdmin\Grid;
use Huojunhao\LaraAdmin\Show;


class AdminUserController extends AdminBaseController
{
    use AdminUserTrait;

}
