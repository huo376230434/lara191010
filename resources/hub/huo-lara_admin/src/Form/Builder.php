<?php

namespace Huojunhao\LaraAdmin\Form;

use Encore\Admin\Form;

/**
 * Class Builder.
 */
class Builder extends Form\Builder
{


    /**
     * Do initialize.
     */
    public function init()
    {
        $this->tools = new Tools($this);
        $this->footer = new Footer($this);
    }





}
