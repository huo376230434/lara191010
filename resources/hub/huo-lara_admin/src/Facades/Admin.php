<?php

namespace Huojunhao\LaraAdmin\Facades;

use Huojunhao\LaraAdmin\ChildAdmin;
use Huojunhao\LaraAdmin\Form;
use Huojunhao\LaraAdmin\Grid;
use Huojunhao\LaraAdmin\Layout\Content;
use Huojunhao\LaraAdmin\Show;
use Huojunhao\LaraAdmin\Tree;
use Illuminate\Support\Facades\Facade;




/**
 * Class Admin.
 *
 * @method static Grid grid($model, \Closure $callable)
 * @method static Form form($model, \Closure $callable)
 * @method static Show show($model, $callable = null)
 * @method static Tree tree($model, \Closure $callable = null)
 * @method static Content content(\Closure $callable = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void css($css = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void js($js = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void headerJs($js = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void script($script = '')
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void style($style = '')
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void html($html = '')
 * @method static \Illuminate\Contracts\Auth\Authenticatable|null user()
 * @method static \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard guard()
 * @method static string title()
 * @method static void navbar(\Closure $builder = null)
 * @method static void registerAuthRoutes()
 * @method static void extend($name, $class)
 * @method static void disablePjax()
 * @method static void booting(\Closure $builder)
 * @method static void booted(\Closure $builder)
 * @method static void bootstrap()
 *
 * @see ChildAdmin
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ChildAdmin::class;
    }
}
