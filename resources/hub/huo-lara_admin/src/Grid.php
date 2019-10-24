<?php
namespace Huojunhao\LaraAdmin;
use Closure;
use Huojunhao\LaraAdmin\Exception\Handler;
use Huojunhao\LaraAdmin\Grid\Column;
use Huojunhao\LaraAdmin\Grid\Filter;
use Huojunhao\LaraAdmin\Grid\Model;
use Huojunhao\LaraAdmin\Grid\Tools;
use Huojunhao\LaraAdmin\Grid\Displayers;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019/2/8
 * Time: 上午10:06
 */
class Grid extends \Encore\Admin\Grid{


//    protected $create_url = '';

    protected $view = 'admine::grid.table';

    /**
     * Grid constructor.
     * @param Eloquent $model
     * @param Closure|null $builder
     */
    public function __construct(Eloquent $model, Closure $builder = null)
    {
        $this->model = new Model($model, $this);
        $this->keyName = $model->getKeyName();
        $this->builder = $builder;

        $this->initialize();

        $this->handleExportRequest();

        $this->callInitCallbacks();


    }


    protected function initTools()
    {
        $this->tools = new Tools($this);

        return $this;
    }

    protected function initFilter()
    {
        $this->filter = new Filter($this->model());

        return $this;
    }


    /**
     * Get the string contents of the grid view.
     *
     * @return string
     * @throws \Throwable
     */
    public function render()
    {
        $this->handleExportRequest(true);

        try {
            $this->build();
        } catch (\Exception $e) {
            return Handler::renderException($e);
        }

        $this->callRenderingCallback();

        return view($this->view, $this->variables())->render();
    }


    public function renderColumnSelector()
    {
        return (new Grid\Tools\ColumnSelector($this))->render();
    }



    public function renderCreateButton()
    {
        return (new Tools\CreateButton($this))->render();
    }



    /**
     * Add column to grid.
     *
     * @param string $column
     * @param string $label
     *
     * @return Column
     */
    protected function addColumn($column = '', $label = '')
    {
        $column = new Column($column, $label);
        $column->setGrid($this);

        return tap($column, function ($value) {
            $this->columns->push($value);
        });
    }




    /**
     * Get action display class.
     *
     * @return \Illuminate\Config\Repository|mixed|string
     */
    public function getActionClass()
    {
        if ($this->actionsClass) {
            return $this->actionsClass;
        }

        if ($class = config('admin.grid_action_class')) {
            return $class;
        }

        return Grid\Displayers\Actions::class;
    }


    /**
     * Prepend checkbox column for grid.
     *
     * @return void
     */
    protected function prependRowSelectorColumn()
    {
        if (!$this->option('show_row_selector')) {
            return;
        }

        $checkAllBox = "<input type=\"checkbox\" class=\"{$this->getSelectAllName()}\" />&nbsp;";

        $this->prependColumn(Column::SELECT_COLUMN_NAME, ' ')
            ->displayUsing(Displayers\RowSelector::class)
            ->addHeader($checkAllBox);
    }

}
