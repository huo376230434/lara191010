<?php

namespace Huojunhao\LaraAdmin\BaseExtends\Form;

use App\Admin\Extensions\Form\Field\CommonTrait;
use Encore\Admin\Form\Field;

class Area extends Field
{
    use CommonTrait;

    protected $view="admin.base_extends.form.area";
    public function prepare($value)
    {
        return 5;
        dd($value);
    }
    public function render()
    {
//        $this->script = <<<EOT
//
//CodeMirror.fromTextArea(document.getElementById("{$this->id}"), {
//    lineNumbers: true,
//    mode: "text/x-php",
//    extraKeys: {
//        "Tab": function(cm){
//            cm.replaceSelection("    " , "end");
//        }
//     }
//});
//
//EOT;
        return parent::render();

    }

}
