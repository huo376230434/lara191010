<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 9:27
 */

namespace Huojunhao\LaraAdmin\BaseExtends\Widgets;
use Encore\Admin\Widgets\Widget;
use Illuminate\Contracts\Support\Renderable;

class NormalLink extends Widget implements Renderable {
    use NormalLinkTrait;

    /**
     * @var string
     */
    protected $view = 'admine::base.pieces.normal_link';



    public static function obj($title,$url,$color_type="primary",$pull_right=false,$addon_class='') : NormalLink
    {
        return new static(...func_get_args());
    }


    /**
     * Box constructor.
     *
     * @param string $title
     * @param string $content
     */
    public function __construct($title,$url,$color_type="primary",$pull_right=false,$addon_class='')
    {
        $this->url = $url;
        $this->title =  $title;
        $this->color_type= $color_type;
        $this->pull_right = $pull_right;
        $this->addon_class = $addon_class;
        $this->isNormalLink();
        parent::__construct();
    }


    /**
     * @return array|mixed|string
     * @throws \Throwable
     */
    public function render(){

//        dd(get_object_vars($this));
        $data = get_object_vars($this);


        return view($this->view, $data)->render();
    }


}
