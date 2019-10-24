<?php
namespace Huojunhao\LaraAdmin\Grid\Displayers;

use Huojunhao\LaraAdmin\Grid;
use Huojunhao\LaraAdmin\Grid\Column;

/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019/2/11
 * Time: 下午4:34
 */
class Actions extends \Encore\Admin\Grid\Displayers\Actions{

    protected $actions = ['edit','view',  'delete'];

    /**
     * Create a new displayer instance.
     *
     * @param mixed     $value
     * @param Grid      $grid
     * @param Column    $column
     * @param \stdClass $row
     */
    public function __construct($value, Grid $grid, Column $column, $row)
    {
        $this->value = $value;
        $this->grid = $grid;
        $this->column = $column;
        $this->row = $row;
    }


    /**
     * Render view action.
     *
     * @return string
     */
    protected function renderView()
    {
        return <<<EOT
<a href="{$this->getResource()}/{$this->getRouteKey()}" class="{$this->grid->getGridRowName()}-view">
    详情
</a>
EOT;
    }


    /**
     * Render edit action.
     *
     * @return string
     */
    protected function renderEdit()
    {
        return <<<EOT
<a href="{$this->getResource()}/{$this->getRouteKey()}/edit" class="{$this->grid->getGridRowName()}-edit">
    编辑
</a>
EOT;
    }


    /**
     * Render delete action.
     *
     * @return string
     */
    protected function renderDelete()
    {
        $this->setupDeleteScript();

        return <<<EOT
<a  href="javascript:void(0);" data-id="{$this->getKey()}" class="{$this->grid->getGridRowName()}-delete text-danger">
    删除
</a>
EOT;
    }

}
