<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 9:27
 */

namespace Huojunhao\LaraAdmin\BaseExtends\Widgets;
use Encore\Admin\Admin;
use Huojunhao\LaraAdmin\BaseExtends\Widgets\Bt3Modals\BaseBtp3Modal;
use Illuminate\Contracts\Support\Renderable;
use Encore\Admin\Widgets\Widget;
class OperateWithMsg extends BaseBtp3Modal implements Renderable {
    protected $modal_tag="operate_with_msg";
    protected $modal_view = 'admine::base.bt3modals.modal_pieces.operate_with_msg.operate_with_msg_modal';
    protected $js_view = 'admine::base.bt3modals.modal_pieces.operate_with_msg.operate_with_msg_js';

}
