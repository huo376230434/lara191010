<?php

namespace Huojunhao\LaraAdmin\Form\Field;

class Time extends Date
{
    use CommonTrait;


    protected $format = 'HH:mm:ss';

    public function render()
    {
        $this->prepend('<i class="fa fa-clock-o fa-fw"></i>')
            ->defaultAttribute('style', 'width: 150px');

        return parent::render();
    }
}
