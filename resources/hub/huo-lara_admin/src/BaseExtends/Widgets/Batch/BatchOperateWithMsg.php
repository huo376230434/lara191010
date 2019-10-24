<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 9:27
 */

namespace Huojunhao\LaraAdmin\BaseExtends\Widgets\Batch;
use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\BatchAction;

class BatchOperateWithMsg  extends BatchAction    {

    /**
     * @var string
     */

    protected $content = [];

    protected $url;

    protected $title;
    protected $id;
    protected $icon;
    protected $color_type;
    protected $msg = '';
    protected $is_btn;
    /**
     * Box constructor.
     *
     * @param string $title
     * @param string $content
     */
    public function __construct($url,$title='操作',$color="primary")
    {
        $this->url = $url;
        $this->title = $title;
        $this->color_type= $color;

    }

    public function script()
    {

        $title_html = "<span class=\"text-" . $this->color_type . "\">" . $this->title . "</span>";
        return <<<SCRIPT

$('{$this->getElementClass()}').on('    click', function() {


$('#operate-with-msg-modal').modal('toggle')
$("#operate-with-msg-textarea").val('');
$("#operate-with-msg-title").html('$title_html');
$("#operate-with-msg-form").attr("action",'$this->url');
$('#operate-with-msg-submit').unbind('click').click(function(){

var text = $("#operate-with-msg-textarea").val();
console.log(text);
if(!text){
$("#operate-with-msg-textarea-tips").html("不能为空哦！").show();
return false;
}

$("#operate-with-msg-textarea-tips").html("").hide();

        $.ajax({
            method: 'post',
            url:'$this->url',
            data: {
                _method:'post',
                _token:LA.token,
                   ids: selectedRows(),
                content:text

            },
            success: function (data) {

                $.pjax.reload('#pjax-container');

                if (typeof data === 'object') {
                if (typeof data === 'object') {
                    if (data.status) {
            $("#operate-with-msg-modal").modal("hide");
              toastr.success('成功',"33",{positionClass:'toast-top-center'})

            
                    } else {
                    
  toastr.error('',data.message.title,{positionClass:'toast-top-center'})

                    }
                }
                }
            },
            error: function(data){
  toastr.error('失败',"",{positionClass:'toast-top-center'})


            }
        });
    });








});

SCRIPT;

    }

}
