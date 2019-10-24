<?php

namespace Huojunhao\LaraAdmin\Form\Field;

class Email extends Text
{
    use CommonTrait;

    protected $rules = 'nullable|email';

    public function render()
    {
        $this->prepend('<i class="fa fa-envelope fa-fw"></i>')
            ->defaultAttribute('type', 'email');

        return parent::render();
    }
}
