<?php

namespace Huojunhao\LaraAdmin\BaseExtends;



class AdminViewUtil
{
    public static function backBtn($redirect_url=null)
    {
        $url = $redirect_url ?: 'javascript:history.back()';
        return <<<DDD
<a href="$url" class="btn btn-default">返回</a>
DDD;


    }


    public static function createBtn($url)
    {
        return <<<DDD
<a href="{{$url}}" class="btn btn-sm btn-success" title="新增">
        <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;新增</span>
    </a>
DDD;

    }



}
