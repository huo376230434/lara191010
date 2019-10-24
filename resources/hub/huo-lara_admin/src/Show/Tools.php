<?php

namespace Huojunhao\LaraAdmin\Show;

use Illuminate\Support\Collection;

class Tools extends \Encore\Admin\Show\Tools
{
    public function __construct(Panel $panel)
    {
        $this->panel = $panel;

        $this->appends = new Collection();
        $this->prepends = new Collection();
    }

}
