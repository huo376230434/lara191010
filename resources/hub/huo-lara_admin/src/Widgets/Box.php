<?php

namespace Huojunhao\LaraAdmin\Widgets;


class Box extends  \Encore\Admin\Widgets\Box
{

    /**
     * Box constructor.
     *
     * @param string $title
     * @param string $content
     */
    public function __construct($title = '', $content = '', $footer = '')
    {

        parent::__construct($title, $content,$footer);
//        $this->class('box shadow');
    }

}
