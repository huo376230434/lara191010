<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 9:27
 */

namespace Huojunhao\LaraAdmin\BaseExtends\Widgets;
use Encore\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;
use Encore\Admin\Widgets\Widget;
class DoWithConfirm extends Widget implements Renderable {
use  NormalLinkTrait;
    /**
     * @var string
     */
    protected $view = 'admine::base.pieces.do_with_confirm';

    protected $content = [];


    protected $primary_key;

    protected $msg = '';

    protected $success_redirect_url;

    protected $uuid_class;

    protected $is_redirect=0;


    /**
     * Box constructor.
     *
     * @param string $title
     * @param string $content
     */
    public function __construct($title,$url,$primary_key='',$msg = '',$color_type="primary",$success_redirect_url='')
    {
        $this->url = $url;
        $this->title = $title;
        $this->primary_key = $primary_key;
        $this->color_type= $color_type;
        if ($msg) {
            $this->msg = $msg;
        }else{
            $this->msg = "确定" . $title . "?";
        }

        $this->isBtn();
        $this->success_redirect_url = $success_redirect_url;
        $this->uuid_class = 'do-with-confirm'.md5($title.$primary_key);
        parent::__construct();
    }

    public static function obj($title,$url,$primary_key='',$msg = '',$color_type="primary",$is_btn=true,$success_redirect_url='',$change_location = false) : DoWithConfirm
    {
        return new static(...func_get_args());
    }

    /**
     * @param string $primary_key
     * @return DoWithConfirm
     */
    public function setPrimaryKey(string $primary_key): DoWithConfirm
    {
        $this->primary_key = $primary_key;
        return $this;
    }



    /**
     * @param string $msg
     * @return DoWithConfirm
     */
    public function setMsg(string $msg): DoWithConfirm
    {
        $this->msg = $msg;
        return $this;
    }



    /**
     * @param string $success_redirect_url
     * @return DoWithConfirm
     */
    public function setSuccessRedirectUrl(string $success_redirect_url): DoWithConfirm
    {
        $this->success_redirect_url = $success_redirect_url;
        return $this;
    }

    /**
     * @param string $uuid_class
     * @return DoWithConfirm
     */
    public function setUuidClass(string $uuid_class): DoWithConfirm
    {
        $this->uuid_class = $uuid_class;
        return $this;
    }



    /**
     * @param bool $is_redirect
     * @return DoWithConfirm
     */
    public function isRedirect(): DoWithConfirm
    {
        $this->is_redirect = 1;
        return $this;
    }



    protected function script()
    {
        $is_redirect = $this->is_redirect;
        $is_blank = $this->blank;
        $cancel = trans('admin.cancel');
//        $('.{$this->uuid_class}').unbind('click').click(function() {
        return <<<SCRIPT

$('body').delegate('.{$this->uuid_class}','click',function(){
    var primary_key = $(this).data('primary_key');
    var msg = $(this).data('msg');

    var url = $(this).data('url');
    //debugger;
    swal({
        title: msg,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00a65a",
        confirmButtonText: "确认",
        showLoaderOnConfirm:true,
        cancelButtonText: "$cancel",
        preConfirm: function() {
       
       if($is_redirect ){
       if($is_blank){
              window.open(url);

       }else{
              window.location.href=url
       }
       return;
       }
            return new Promise(function(resolve) {

                $.ajax({
                    method: 'post',
                    url: url,
                    data: { 
                        _token:LA.token,
                        primary_key:primary_key 
                    },
                    success: function (data) {

                        if (typeof data === 'object') {
                            if (data.status) {
                       
                              swal(data.message, '', 'success').then(function(){
                              
                              var redirect_url='{$this->success_redirect_url}';
                              
                              if($is_redirect){
                              location.href=redirect_url;
                              }else{
                              $.pjax.reload('#pjax-container');

                              }
                              
                              });
      
                            } else {

                                swal(data.message, '', 'error');
                            }
                        }
                    },
                    error:function(e){
                    
                    console.log(e.status)
                    if(e.status=='419')
                    {
                     swal("您有段时间没操作了，请手动刷新页面再重新操作！", '', 'error');

                 
                    }else{
                    swal("系统出错", '', 'error');

                    }
                    
                    }
                });
            });
        }
    })
});





SCRIPT;

    }

    public function render(){

        Admin::script($this->script());

        $data = get_object_vars($this);
        $data['msg'] = $this->msg ?: "确定" . $this->title . "?";



        return view($this->view, $data)->render();
    }
}
