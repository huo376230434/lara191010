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
class TenancyUser extends Administrator{

use BaseModelTrait;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $connection = config('tenancy.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('tenancy.database.users_table'));

    }

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
