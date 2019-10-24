<?php
namespace Huojunhao\LaraAdmin\Grid;


use Huojunhao\LaraAdmin\Grid\Tools\BatchActions;
use Huojunhao\LaraAdmin\Grid\Tools\FilterButton;

/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019/2/11
 * Time: 下午4:18
 */
class Tools extends \Encore\Admin\Grid\Tools{

    /**
     * Append default tools.
     */
    protected function appendDefaultTools()
    {
        $this->append(new BatchActions())
            ->append(new FilterButton());
    }
}
