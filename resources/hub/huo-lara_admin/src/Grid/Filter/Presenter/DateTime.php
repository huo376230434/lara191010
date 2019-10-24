<?php

namespace Huojunhao\LaraAdmin\Grid\Filter\Presenter;

use Encore\Admin\Admin;
use Illuminate\Support\Arr;

class DateTime extends \Encore\Admin\Grid\Filter\Presenter\DateTime
{
    use PresenterCommonTrait;

    /**
     * @var string
     */
    protected $format = 'YYYY-MM-DD HH:mm:ss';

}
