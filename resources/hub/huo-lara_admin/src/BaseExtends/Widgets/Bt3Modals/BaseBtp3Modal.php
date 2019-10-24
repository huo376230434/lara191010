<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 9:27
 */

namespace Huojunhao\LaraAdmin\BaseExtends\Widgets\Bt3Modals;
use Encore\Admin\Widgets\Widget;
use Huojunhao\LaraAdmin\BaseExtends\Widgets\NormalLinkTrait;
use Illuminate\Contracts\Support\Renderable;

abstract class BaseBtp3Modal extends Widget implements Renderable {

    use NormalLinkTrait;

    protected $primary_key;
    protected $msg;
    protected $extra_params = [];
    protected $trigger_view = 'admine::base.pieces.bt3modal_trigger';
    protected $modal_view = '';
    protected $js_view = '';
    protected $uuid_class;

    protected $modal_tag="base_btp3_modal";
    protected $data_extra = "";


    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }

    public function setDataExtra($extra)
    {
        $this->data_extra .= " $extra ";
        return $this;
    }

    public static function obj($title,$url,$primary_key=0,$msg=null,$color_type="primary",$pull_right=false,$addon_class='',$extra_params=[])
    {
        return new static(...func_get_args());
    }


    /**
     * Box constructor.
     *
     * @param string $title
     * @param string $content
     */
    public function __construct($title,$url,$primary_key=0,$msg=null,$color_type="primary",$pull_right=false,$addon_class='',$extra_params=[])
    {
        $this->url = $url;
        $this->title =  $title;
        $this->color_type= $color_type;
        $this->pull_right = $pull_right;
        $this->addon_class = $addon_class;
        $this->primary_key = $primary_key;
        $this->msg = $msg ? : $this->title;
        $this->extra_params = $extra_params;
        $this->isBtn();

        $this->uuid_class = $this->modal_tag;


        parent::__construct();
    }



//    /**
//     * @var string
//     */
//    protected $view = 'admin::base_extends.bt3modals.base_modal';
//
//    protected $handle_type = "";
//    protected $content = [];
//    protected $url;
//    protected $title;
//    protected $id;
//    protected $icon;
//    protected $color_class;
//    protected $msg;
//    protected $extjs_path = "views/admin/base_extends/bt3modals/base_modal_ext.js";
//    protected $extra_params = [];
//    protected $btn_big;
//    /**
//     * @param mixed $btn_big
//     */
//    public function setBtnBig()
//    {
//        $this->btn_big = true;
//        return $this;
//    }
//
//
//    /**
//     * 所有关于静态变量的操作都要在子类中重写一遍，否则就调到父类的静态变量去了
//     * @var bool
//     */
//    protected static $rendered=false;
//
//
//    public function isRendered()
//    {
//        return static::$rendered;
//
//    }
//
//    public function setRendered()
//    {
//        static::$rendered = true;
//    }
//    /**
//     * Box constructor.
//     *
//     * @param string $title
//     * @param string $content
//     */
//    public function __construct($title,$url='',$id=0,$msg = '',$color_type="primary",$is_btn=true,$extra_prarms=[])
//    {
//        $this->url = $url;
//        $this->title = $title;
//        $this->id = $id;
////        dump($color_type);
//        $this->color_type= $color_type ?: 'primary';
//        $this->is_btn = $is_btn ;
//        $msg && $this->msg = $msg;
//        $this->extra_params = $extra_prarms;
//
//        parent::__construct();
//
//    }
//
//
//    protected function extjs()
//    {
//        return file_get_contents(resource_path($this->extjs_path));
//    }
//
//
//
//    protected function script()
//    {
//        $extjs = $this->extjs();
//        $js = file_get_contents(resource_path("views/admin/base_extends/bt3modals/base_modal.js"));
//        $js = str_replace("//hook_function", $extjs, $js);
//        $js = str_replace("dummy_modal_prefix", $this->handle_type, $js);
//        return $js;
//    }
//
//
//    public function baseData()
//    {
//        return [
//            "title" => $this->title,
//            "id" => $this->id,
//            "url" => $this->url,
//            "is_btn" => $this->is_btn,
//            "color_type" => $this->color_type,
//            "msg" => $this->msg ? : $this->title,
//            "handle_type" => $this->handle_type,
//            "btn_big" => $this->btn_big,
//            'extra_params' => $this->extra_params,
//            "rendered" => $this->isRendered()
//        ];
//
//    }
//
//    public function customData()
//    {
//        return [
//
//        ];
//    }
//
//    public function modalData()
//    {
//        return [
//
//        ];
//    }
//

    public function render(){

//        dd(get_object_vars($this));
        $data = get_object_vars($this);
        \Admin::html(view($this->modal_view, $data)->render());
        \Admin::html(view($this->js_view, $data)->render());

        return view($this->trigger_view, $data)->render();
//        $data = array_merge($this->customData(),$this->baseData());
//        if (!$this->isRendered()) {
//            \Admin::script($this->script());
//            $this->setRendered();
//
////            $params = array_merge([
////                'handle_type' => $data['handle_type']
////            ], $this->modalData());
//
//            //模态框的参数加上第一次的所有参数
//            $params = array_merge($this->baseData(), $this->modalData());
//
//            CusAdmin::modals([
//                'name' => "admine::custom.bt3modals.".$data['handle_type'].'.'.$data['handle_type']."_modal",
//                'params' => $params
//            ]);
//        }
//
//        return view($this->view, $data)->render();
    }


}
