<?php

namespace App\HttpAdmin\Controllers;

use App\HttpAdmin\Controllers\Base\AdminBaseController;
use Huojunhao\LaraAdmin\Form;
use Huojunhao\LaraAdmin\Grid;
use Huojunhao\LaraAdmin\Show;


class DummySimpleNameController extends AdminBaseController
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
        $grid = new Grid(new DummyModelName);

        //DummyGrid

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
        $show = new Show(DummyModelName::findOrFail($id));

        //DummyShow

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new DummyModelName);

        //DummyForm

        return $form;
    }
}
