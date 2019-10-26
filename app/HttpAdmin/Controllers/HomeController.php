<?php

namespace App\HttpAdmin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Huojunhao\LaraAdmin\BaseExtends\Widgets\Bt3Modals\OperateWithMsg;

/**
 * Class HomeController
 *
 * @meddileware [ 'admin' , new Post() ]
 * @package App\HttpAdmin\Controllers
 */
class HomeController extends Controller
{

    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row( OperateWithMsg::obj("haha","adf",0)->setMsg("试试"))
            ->row( OperateWithMsg::obj("haha","asdf",1)->setMsg("asdf"))
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
    }

    /**
     * @method any
     */
    public function test()
    {

    }

    /**
     * @method post
     */
    public function testHandle()
    {

    }


}
