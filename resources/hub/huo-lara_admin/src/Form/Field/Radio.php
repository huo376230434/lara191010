<?php

namespace Huojunhao\LaraAdmin\Form\Field;

use Huojunhao\LaraAdmin\CusAdmin;
use Encore\Admin\Form\Field;
use Illuminate\Contracts\Support\Arrayable;

class Radio extends Field\Radio
{
    use CommonTrait;




    public function linkage($hide_names = [], $hide_value = 0)
    {
        $hide_names_str = \GuzzleHttp\json_encode($hide_names);
        $script = <<<EOT
(function(){
    var hide_names = JSON.parse('$hide_names_str');
    var parent_form =  $('[name="{$this->column}"]').parents('form');
    console.log(parent_form);
    function changeRadioLinkage(){
        var radio_value = parent_form.find('[name="{$this->column}"]:checked').val();
        radio_value += '';
        var hide_value = '$hide_value';
        for(var i in hide_names){
            var obj = parent_form.find('[name='+hide_names[i]+']').parents('.form_item_wrap');
         //   console.log(obj);
            if(hide_value != radio_value){
                obj.removeClass('hide')
            }else{
                obj.addClass('hide')
            }
        }
    }
    changeRadioLinkage();

    parent_form.find('[name="{$this->column}"]').off('ifChanged').on('ifChanged',function(){
        changeRadioLinkage();
    })
})()


 
EOT;

        CusAdmin::script($script);
        return $this;

    }

}
