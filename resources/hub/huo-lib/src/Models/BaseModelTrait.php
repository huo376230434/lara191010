<?php

namespace Huojunhao\Lib\Models;


trait BaseModelTrait
{
    protected static $select_column_name = "name";
    protected static $select_column_id = "id";


    public function own()
    {
        return $this->belongsTo(static::class, $this->getKeyName());
    }

    public static function statusOptions($id=null)
    {
        $arr = [
            0 => "禁用",
            1 => "正常"
        ];
        return static::commonReturn($arr, $id);
    }

    public static function isYesOptions($id=null)
    {

        $arr = [
            0 => "否",
            1 => "是"
        ];
        return static::commonReturn($arr, $id);
    }


    public static function selectOptions($id=null)
    {
        $arr = static::all()->pluck(static::$select_column_name, static::$select_column_id)->toArray();
        return static::commonReturn($arr, $id);

    }

    public static function selectOptionsWithKey()
    {
        return static::select(static::$select_column_name,static::$select_column_id)->get()->toArray();

    }

    public static function selectOptionsWithAll($total_text="全部",$id=0)
    {
        $arr = static::selectOptionsWithKey();

        array_unshift($arr,[
            static::$select_column_name => $total_text,
            static::$select_column_id => $id
        ]);
        return $arr;
    }


    protected static function commonReturn($arr,$id,$get_key=false)
    {

        if ($id===null) {
            return $arr;
        }else{
            if ($get_key) {
                //这时是通过值取key
                return array_search( $id,$arr);
            }
            //此时是单个ID对应的文字
            if(key_exists($id, $arr)){
                return $arr[$id];
            }else{
                return "未知";
            };
        }

    }



    public function batchSyncWithIds($relation_method,$id_arr=[],$extra_arr=[])
    {
        $id_arr = array_filter($id_arr);
        $new_arr = [];
        foreach ($id_arr as $item) {
            $new_arr[$item] = $extra_arr;
        }
        $this->$relation_method()->sync($new_arr);

    }




}
