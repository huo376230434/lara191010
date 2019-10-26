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
        
        // 自动生成时间  2019-10-26 19:13
   public function index(){
         
         dump(__METHOD__);

         return true;
   }
        
        // 自动生成时间  2019-10-26 19:13
   public function test(){
         
         dump(__METHOD__);

         return true;
   }
        
        // 自动生成时间  2019-10-26 19:13
   public function addd(){
         
         dump(__METHOD__);

         return true;
   }
        
        // 自动生成时间  2019-10-26 19:19
   public function haha(){
         
         dump(__METHOD__);

         return true;
   }
   
   

}
