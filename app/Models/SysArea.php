<?php

namespace App\Model;


use Huojunhao\Lib\Models\BaseModel;
use Huojunhao\Lib\UtilsTraits\LimitlessSortTrait;
use Illuminate\Support\Facades\DB;

class SysArea extends BaseModel
{
    use LimitlessSortTrait;
    //
    protected static $free_area_id = [32, 33, 34];

    public static function provinces($has_country=false)
    {
        $arr = static::where('parent_id', 0)->whereNotIn('id',static::$free_area_id)->get()->toArray();

       $has_country && array_unshift($arr, static::countryArr());
        return $arr;

    }


    public static function countryArr()
    {
        return ['id' => 0, 'node_id' => 0, 'name' => "中华人民共和国",'index_id'=>1];
    }


    public function subItems()
    {
        return static::where('parent_id', $this->id)->get();

    }


    public static function provinceOptions()
    {
        return static::provinces()->pluck('name', 'id')->toArray();

    }

    public static function relateProvinceOptions($name= "text",$without_free_area=true)
    {
        $free_area_id = [];
        $without_free_area && $free_area_id = static::$free_area_id;
        $arr = static::where('parent_id', 0)->whereNotIn('id',$free_area_id)->get(['id', DB::raw('name as '.$name)])->toArray();
        array_unshift( $arr,['id' => 0,$name => "中华人民共和国"]);
        return $arr;
    }


    public static function relateCityOptions($province_id=null)
    {
        $arr = [];
        if ($province_id) {

            //添加一个首选项默认值
            $arr = static::where('parent_id', $province_id)->where('node_id',1)->get(['id',DB::raw('name as text')])->toArray();
        }
            array_unshift( $arr,['id' => 0,'text' => "请选择"]);
            return $arr;

    }



    public static function relateDistrictOptions($city_id=null)
    {
        $arr = [];
        if ($city_id) {

            //添加一个首选项默认值
            $arr = static::where('parent_id', $city_id)->where('node_id', 2)->get(['id', DB::raw('name as text')])->toArray();
        }
            array_unshift( $arr,['id' => 0,'text' => "请选择"]);
            return $arr;

    }



    public static function citySelectOptionsWithKey($params=[])
    {
        $province_id = $params['id'];
        $name = $params['name'] ?? 'name';
        $arr = static::where('parent_id', $province_id)->where('node_id',1)->get(['id',DB::raw('name as '.$name)])->toArray();

        return $arr;
    }


    public static function districtSelectOptionsWithKey($params=[])
    {
        $city_id = $params['id'];
        $name = $params['name'] ?? 'name';
        $arr = static::where('parent_id', $city_id)->where('node_id',2)->get(['id',DB::raw('name as '.$name)])->toArray();

        return $arr;
    }




    public function parentArea()
    {
            return SysArea::find($this->parent_id);
    }

    public function parent()
    {
        return $this->belongsTo(SysArea::class, 'parent_id');

    }

    public function allIds()
    {
        $arr = [$this->id];
        if ($this->parent_id) {
            array_unshift($arr,$this->parent_id);
            if($this->parent->parent_id ?? false){
                array_unshift($arr, $this->parent->parent_id);
            }
        }
        return $arr;
    }



    public function getFullNameAttribute()
    {

        $arr = [$this->name];
        if ($this->parent->name ?? false) {
            array_unshift($arr,$this->parent->name);
            if($this->parent->parent_id ?? false){
                array_unshift($arr, $this->parent->parent->name);
            }
        }
        return implode($arr,' - ');
    }

    public static function  cities($province_id=null)
    {
        if ($province_id) {
            return static::where('parent_id', $province_id)->where('node_id',1)->get();

        }else{
            return static::where('node_id', 1)->get();
        }
    }

    public static function districts($city_id = null)
    {
        if ($city_id) {
            return static::where('parent_id', $city_id)->where('node_id',2)->get();

        }else{
            return static::where('node_id', 2)->get();

        }
    }


    //性能有问题，要优化
    public static function allAreas()
    {

return \Cache::remember('all_sys_areas',1,function(){
    $all = static::all()->toArray();
    return  static::unlimitedForLayer($all,0,'parent_id');

});
    }


    public static function allAreasWithCountry()
    {
        return \Cache::remember('all_sys_areas_with_country',100,function(){
            return [
                ['id' => 0,'name' => '中国','parent_id' => -1,'node_id' => -1 ,'code' => '000000','children' => static::allAreas()]
            ];
        });

    }

}
