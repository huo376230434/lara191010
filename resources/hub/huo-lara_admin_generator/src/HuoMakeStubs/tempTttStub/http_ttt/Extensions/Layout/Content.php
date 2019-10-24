<?php

namespace App\HttpTenancy\Extensions\Layout;

use Closure;
use Illuminate\Contracts\Support\Renderable;

class Content extends \Huojunhao\LaraAdmin\Layout\Content
{

    protected $content = "tenancy::content";
    /**
     * Render this content.
     *
     * @return string
     */


    public function render()
    {
        $items = [
            'header'      => $this->title,
            'description' => $this->description,
            'breadcrumb'  => $this->breadcrumb,
            'content'     => $this->build(),
        ];

        return view($this->content, $items)->render();
    }

}
