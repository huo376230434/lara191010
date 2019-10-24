<?php

namespace App\HttpDummyModule\Controllers;

use App\HttpDummyModule\Controllers\Base\DummyModuleBaseController;
use Huojunhao\LaraAdmin\Form;
use Huojunhao\LaraAdmin\Grid;
use Huojunhao\LaraAdmin\Show;


class DummyModelController extends DummyModuleBaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '操作记录管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new \App\Models\DummyModel);

        $grid->column('id', __('Id'));
$grid->column('DummycamelUserModel.name', __('Admin user Name'));
$grid->column('message', __('Message'));
$grid->column('created_at', __('Created at'));
//$grid->column('updated_at', __('Updated at'));
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->filter(function(Grid\Filter $filter){
            $filter->disableIdFilter();
            $filter->equal("DummySnakeUserModel_id", __('Admin user Name'))->select(\App\Models\DummyUserModel::selectOptions());

            $filter->like("message", "消息");
        });
        $grid->actions(function(Grid\Displayers\Actions $actions){
            $actions->disableView();
            $actions->disableEdit();
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
        $show = new Show(\App\Models\DummyModel::findOrFail($id));

        $show->field('id', __('Id'));
$show->field('DummySnakeUserModel_id', __('Admin user id'));
$show->field('message', __('Message'));
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
        $form = new Form(new \App\Models\DummyModel);

        $form->number('DummySnakeUserModel_id', __('Admin user id'));
$form->text('message', __('Message'));


        return $form;
    }
}
