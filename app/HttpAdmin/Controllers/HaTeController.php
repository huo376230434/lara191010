<?php

namespace App\HttpAdmin\Controllers;

use App\HttpAdmin\Controllers\Base\AdminBaseController;
use Huojunhao\LaraAdmin\Layout\Content;

/**
 * 自动生成时间  2019-10-27 19:09
 *
 *真用middleware时要把后边的_eg去掉
 * @middlewares_eg   testHandle => [ 'admin' ] ;
 *  test => [ 'admin' , new \App\Models\Post() ] ;
 *
 */
class HaTeController extends AdminBaseController
{
        

        
    /**
     * 自动生成时间  2019-10-27 19:12
     * @http_method any
     */
   public function tt(){
       dump(__METHOD__);
         return __METHOD__;
   }
        
    /**
     * 自动生成时间  2019-10-27 19:15
     * @http_method any
     */
   public function test(){
       dump(__METHOD__);

       return __METHOD__;
   }


    /**
     * 自动生成时间  2019-10-27 19:15
     * @http_method any
     */
    public function view(Content $content)
    {

        $content->view("admin.views.haha",[

        ]);
        return $content;

   }
   
   

}
