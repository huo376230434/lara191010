<?php

namespace Huojunhao\LaraAdmin\Grid\Filter;

use Huojunhao\LaraAdmin\Grid\Filter\Presenter\Text;

class Like extends \Encore\Admin\Grid\Filter\Like
{
    use  FilterCommonTrait;

    protected function setupDefaultPresenter()
    {

        $this->setPresenter(new Text($this->label));
    }
}
