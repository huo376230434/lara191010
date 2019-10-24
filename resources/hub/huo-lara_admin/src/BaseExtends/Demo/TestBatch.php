<?php
namespace Huojunhao\LaraAdmin\BaseExtends\Demo\Batch;
use Encore\Admin\Grid\Tools\BatchAction;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 9:27
 */

class TestBatch extends BatchAction   {

    protected $options;
    protected $url;
    protected $html;

    public function __construct($url,$options=[])
    {
        $this->url = $url;
        $this->options = $options ? : ['test1' => 't1','test2' => 't2'];
    }


    public function html()
    {


        $this->html = "<select class=\"form-control\" name=\"des_admin_user_id\" id=\"\">";
        foreach ($this->options as $k => $v) {
            $this->html .= "<option value=\"$k\">$v</option>";
        }

        $this->html .= "</select>";



    }



    public function script()
    {
        $this->html();
        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {




    swal({
      title: "选择划拨对象",
      text:'{$this->html}',
      html:true,
      showCancelButton: true,
      confirmButtonColor: "#00a65a",
      confirmButtonText: "确认",
      closeOnConfirm: false,
      cancelButtonText: "取消"
    },
    function(){
    

    var des_admin_user_id = $('[name="des_admin_user_id"]').val()
        $.ajax({
            method: 'post',
        url: '{$this->url}',
            data: {
                _method:'post',
                _token:LA.token,
                ids: selectedRows(),
                des_admin_user_id:des_admin_user_id

            },
            success: function (data) {
//console.log(data)

                if (typeof data === 'object') {
                    if (data.status) {
               $.pjax.reload('#pjax-container');

                        swal(data.message, '', 'success');
                    } else {

                        swal(data.message, '', 'error');
                    }
                }
            }
        });
    });
});


EOT;

    }



}
