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

class BatchDoWithConfirm  extends BatchAction    {

    /**
     * @var string
     */

    protected $url;

    protected $msg = '';
    /**
     * Box constructor.
     *
     * @param string $title
     * @param string $content
     */
    public function __construct($url,$msg = '')
    {
        $this->url = $url;
        $this->msg = $msg;

    }

    public function script()
    {


        return <<<SCRIPT

$('{$this->getElementClass()}').on('click', function() {

    swal({
      title: "{$this->msg}",
            type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#00a65a",
      confirmButtonText: "确认",
        showLoaderOnConfirm:true,
      cancelButtonText: "取消",
      preConfirm: function() {
            return new Promise(function(resolve) {

                $.ajax({
                    method: 'post',
                    url: '{$this->url}',
                    data: {
                        _token:LA.token,
                        ids: selectedRows(),   
                          },
                    success: function (data) {
                        $.pjax.reload('#pjax-container');

                        if (typeof data === 'object') {
                            if (data.status) {

                                swal(data.message, '', 'success');
                            } else {

                                swal(data.message, '', 'error');
                            }
                        }
                    },
                        error:function(){
                                   swal("系统出错", '', 'error');
                    }
                });
            });
      }
    })
});

SCRIPT;

    }

}
