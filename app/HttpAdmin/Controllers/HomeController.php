<?php

namespace App\HttpAdmin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Huojunhao\LaraAdmin\BaseExtends\Widgets\Bt3Modals\OperateWithMsg;

/**
 * Class HomeController
 *
 * @middlewares_bf   testHandle => [ 'admin' , new \App\Models\Post() ] ;
 *  test => [ 'admin' , new \App\Models\Post() ] ;
 *  index => [ 'admin' , new \App\Models\Post() ] ;

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
     *
     * @http_method get
     */
    public function test($id,Post $post)
    {

    }

    /**
     * @http_method post
     */
    public function testHandle()
    {
echo 11;
    }


}
