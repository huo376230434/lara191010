<?php

namespace App\Models;




use App\Models\ExtraModelTraits\PostRelationTrait;
use App\Models\ExtraModelTraits\PostStaticTrait;
use Huojunhao\Lib\Models\BaseModel;


class Post extends BaseModel
{
    use PostRelationTrait,PostStaticTrait;


    public static function boot()
    {
        parent::boot();
//        static::deleting(function(Post $model){
//            $model->indexTypeList()->delete();
//        });
    }




    //
}
