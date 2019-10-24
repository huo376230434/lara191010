<?php

namespace Huojunhao\LaraAdmin\BaseExtends\Plugins\Config;

use App\HttpAdmin\Controllers\Base\AdminBaseController;
use Huojunhao\LaraAdmin\Form;
use Huojunhao\LaraAdmin\Grid;
use Huojunhao\LaraAdmin\Show;

class ConfigController extends AdminBaseController
{

    public $title = "配置项管理";

    public function detail($id)
    {
        $show = new Show(ConfigModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('value', __('Config value'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        return $show;
    }

    /**
     * @return Grid
     */
    public function grid()
    {
        $grid = new Grid(new ConfigModel());
        $grid->model()->orderByDesc('name');
        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('value', __('Config value'));
        $grid->column('description', __('Description'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    public function form()
    {
        $form = new Form(new ConfigModel());

        $form->display('id', __('Id'));
        $form->text('name',__('Name'))->rules('required');
        $form->textarea('value',__('Config value'))->rules('required');
        $form->textarea('description',__('Description'));

        return $form;
    }
}
