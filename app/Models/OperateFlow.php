<?php

namespace App\Models;

use Huojunhao\Lib\Models\BaseModel;

class OperateFlow extends BaseModel
{

    public function adminUser()
    {
        return $this->belongsTo(\App\Models\Base\AdminUser::class);
    }

    public static function log( $msg)
    {

            $admin = \Admin::user();
            $flow = new static();
            $flow->admin_user_id = $admin->id;
        //暂时不用角色
//        $flow->message = $admin->roles->first()->name. $admin->name . $msg;

            $flow->message = $admin->name . $msg;

            $flow->save();

    }



}
