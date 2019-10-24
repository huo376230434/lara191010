<?php

namespace Huojunhao\LaraAdmin\Form\Field;

class Url extends Text
{
    use CommonTrait;

    protected $rules = 'nullable|url';

    public function render()
    {
        $this->prepend('<i class="fa fa-internet-explorer fa-fw"></i>')
            ->defaultAttribute('type', 'url');

        return parent::render();
    }
}
