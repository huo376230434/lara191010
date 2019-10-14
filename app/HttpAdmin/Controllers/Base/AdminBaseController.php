<?php
/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019-10-14
 * Time: 17:03
 */
namespace App\HttpAdmin\Controllers\Base;
use Encore\Admin\Controllers\AdminController;

class AdminBaseController extends AdminController{

    public function __construct()
    {
        if ($init_title = $this->initTitle()) {
            $this->title = $init_title;
        }
    }


    protected function initTitle()
    {
        return '';
    }

}
