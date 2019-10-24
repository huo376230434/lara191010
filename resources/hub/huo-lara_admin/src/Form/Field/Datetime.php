<?php

namespace Huojunhao\LaraAdmin\Form\Field;

class Datetime extends Date
{
    use CommonTrait;

    protected $format = 'YYYY-MM-DD HH:mm:ss';

    public function render()
    {
        $this->defaultAttribute('style', 'width: 160px');

        return parent::render();
    }
}
