<?php

namespace Huojunhao\LaraAdmin\Form\Field;

use Encore\Admin\Form\Field\Text as ParentText;

class Text extends  ParentText
{
    use CommonTrait;



    /**
     * Render this filed.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
//        dd(1);
//        $this->setCustom();

        return parent::render();
    }


}
