<?php

namespace Huojunhao\LaraAdmin\Form\Field;

use Encore\Admin\Form\Field;

class Textarea extends Field\Textarea
{
    use CommonTrait;



    public function render()
    {
//        $this->setCustom();


        return parent::render();
    }








}
