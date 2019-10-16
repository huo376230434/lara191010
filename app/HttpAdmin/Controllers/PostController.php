<?php

namespace App\HttpAdmin\Controllers;

use App\HttpAdmin\Controllers\Base\AdminBaseController;
use App\Models\Post;
use Huojunhao\LaraAdmin\BaseExtends\Widgets\DoWithConfirm;
use Huojunhao\LaraAdmin\BaseExtends\Widgets\NormalLink;
use Huojunhao\LaraAdmin\BaseExtends\Widgets\NormalLinkTrait;
use Huojunhao\LaraAdmin\Form;
use Huojunhao\LaraAdmin\Grid;
use Huojunhao\LaraAdmin\Show;
use Huojunhao\Lib\Base\UrlUtil;
use phpDocumentor\Reflection\Types\Null_;


class PostController extends AdminBaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'DummyTitle';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new \App\Models\Post);

        $grid->column('id', __('Id'));
$grid->column('title', __('Title'));
$grid->column('content', __('Content'));
$grid->column('created_at', __('Created at'));
$grid->column('updated_at', __('Updated at'));

$grid->actions(function(Grid\Displayers\Actions $actions){
    $form = new Form(new Post);
    $form->plainForm();
    $form->text("tt", "adsf");
    $form->textarea("tttt", "adsf");
    $form->setAction('/asdf');

    $actions->append(view('test.modal',[
        'form' => $form
    ]));
    $actions->append(NormalLink::obj("test", ''));
    $actions->append(DoWithConfirm::obj('haha','uuu')->setMsg("真的吗？")->setColorType('danger')->setAddonClass(""));
    $actions->append(NormalLink::obj('normal','http://www.baidu.com')->isBtn()->setColorType('danger')->blank());
    $actions->append(NormalLink::obj("test", 'http://www.baidu.com'));
    $actions->append(NormalLink::obj("test1", 'http://www.baidu.com','danger')->blank());
});
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(\App\Models\Post::findOrFail($id));

        $show->field('id', __('Id'));
$show->field('title', __('Title'));
$show->field('content', __('Content'));
$show->field('created_at', __('Created at'));
$show->field('updated_at', __('Updated at'));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new \App\Models\Post);

        $form->text('title', __('Title'));
$form->textarea('content', __('Content'));


        return $form;
    }
}
