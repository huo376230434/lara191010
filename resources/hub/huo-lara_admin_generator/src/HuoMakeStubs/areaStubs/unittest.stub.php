<?php

namespace Tests\Unit\Plugins;

use App\Models\DummySysArea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DummySysAreaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $provinces = DummySysArea::provinces();
//        dd($provinces);
        $this->assertTrue(count($provinces)===31) ;


        $cities = DummySysArea::cities(1);
//        dd($cities);
        $this->assertTrue(count($cities)===2) ;


        $districts = DummySysArea::districts(35);
//        dd($districts);
        $this->assertTrue(count($districts) === 18);


        $with_country_provinces = DummySysArea::provinces(true);
//        dd($with_country_provinces);
        $this->assertTrue(count($with_country_provinces)===32) ;


        $province = DummySysArea::first();
//        dd($province->subItems()->count());
        $this->assertTrue($province->subItems()->count() === 2);


        $select_provinces = DummySysArea::provinceOptions();
//        dd($select_provinces);
        $this->assertTrue(count($select_provinces) === 31);


        $cities = DummySysArea::cityOptions(1);
//        dd($cities);
        $this->assertTrue(count($cities) === 2);


        $districts = DummySysArea::districtOptions(35);
//        dd($districts);
        $this->assertTrue(count($districts) === 18);


        $district_obj = DummySysArea::find(546);
        $parent =$district_obj->parent;
        self::assertTrue($parent->id === 35);
//        dd($parent);
//        dd($city_obj->allIds());
        self::assertTrue(count($district_obj->allIds()) === 3);
//        dd($district_obj->full_name);
        self::assertTrue($district_obj->full_name == "北京市-北京市-东城区");
//        dd(count(DummySysArea::allAreas()));
        self::assertTrue(count(DummySysArea::allAreas()) === 34);
//        dd(DummySysArea::allAreas());
    }
}
