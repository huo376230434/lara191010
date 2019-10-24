<?php

namespace Huojunhao\LaraAdmin;

use Huojunhao\LaraAdmin\Show\Panel;

class Show extends \Encore\Admin\Show
{
    protected function initPanel()
    {
        $this->panel = new Panel($this);
    }
}
