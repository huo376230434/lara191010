<?php

namespace App\Models;

use Huojunhao\Lib\Models\BaseModel;

class DummyModel extends BaseModel
{

    public function DummycamelUserModel()
    {
        return $this->belongsTo(\App\Models\DummyUserModel::class);
    }

    public static function log( $msg)
    {

            $admin = \DummyModule::user();
            $flow = new static();
            $flow->DummySnakeUserModel_id = $admin->id;
        //暂时不用角色
//        $flow->message = $admin->roles->first()->name. $admin->name . $msg;

            $flow->message = $admin->name . $msg;

            $flow->save();

    }



}
