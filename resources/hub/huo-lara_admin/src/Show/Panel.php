<?php

namespace Huojunhao\LaraAdmin\Show;

use Huojunhao\LaraAdmin\Show;
use Illuminate\Support\Collection;

class Panel extends \Encore\Admin\Show\Panel
{
    protected $view = 'admine::show.panel';

    public function __construct(Show $show)
    {
        $this->parent = $show;

        $this->initData();
    }



    /**
     * Initialize view data.
     */
    protected function initData()
    {
        $this->data = [
            'fields' => new Collection(),
            'tools'  => new Tools($this),
            'style'  => 'info',
            'title'  => trans('admin.detail'),
        ];
    }


}
