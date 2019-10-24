<?php

namespace App\Models;




use App\Models\ExtraModelTraits\DummyModelRelationTrait;
use App\Models\ExtraModelTraits\DummyModelStaticTrait;
use Huojunhao\Lib\Models\BaseModel;


class DummyModel extends BaseModel
{
    use DummyModelRelationTrait,DummyModelStaticTrait;


    public static function boot()
    {
        parent::boot();
//        static::deleting(function(DummyModel $model){
//            $model->indexTypeList()->delete();
//        });
    }




    //
}
