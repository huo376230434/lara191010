<?php
namespace App\Models\Base;
use Encore\Admin\Auth\Database\Administrator;
use Huojunhao\Lib\Models\BaseModelTrait;

/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019-09-10
 * Time: 15:24
 */
class AdminUser extends Administrator{
use BaseModelTrait;
    protected static function boot()
    {
        static::bootTraits();
//        parent::boot();

//        static::deleting(function ($model) {
//            $model->roles()->detach();
//
//            $model->permissions()->detach();
//        });
    }
}
