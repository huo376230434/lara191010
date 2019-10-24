<?php

namespace Huojunhao\LaraAdmin\Grid\Filter;

use Huojunhao\LaraAdmin\Grid\Filter\Presenter\DateTime;
use Huojunhao\LaraAdmin\Grid\Filter\Presenter\Select;
use Huojunhao\LaraAdmin\Grid\Filter\Presenter\Text;

class Equal extends \Encore\Admin\Grid\Filter\Equal
{
use  FilterCommonTrait;

    public function select($options = [])
    {
        return $this->setPresenter(new Select($options));
    }

    protected function setupDefaultPresenter()
    {

        $this->setPresenter(new Text($this->label));
    }


    public function datetime($options = [])
    {

        return $this->setPresenter(new DateTime($options));
    }

}
