<?php

namespace Huojunhao\LaraAdmin\Form\Field;

use Closure;
use Encore\Admin\Form\Field;

class Display extends Field
{
    use CommonTrait;

//    protected $callback;
//
//    public function with(Closure $callback)
//    {
//        $this->callback = $callback;
//    }
//
//    public function render()
//    {
//        $this->setCustom();
//        if ($this->callback instanceof Closure) {
//            $this->value = $this->callback->call($this->form->model(), $this->value);
//        }
//
//        return parent::render();
//    }
}
