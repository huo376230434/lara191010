<?php

namespace App\HttpAdmin\Controllers;

use App\HttpAdmin\Controllers\Base\AdminBaseController;
use Huojunhao\LaraAdmin\Form;
use Huojunhao\LaraAdmin\Grid;
use Huojunhao\LaraAdmin\Show;


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
