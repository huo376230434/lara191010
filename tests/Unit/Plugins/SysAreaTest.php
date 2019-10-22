<?php

namespace Tests\Unit\Plugins;

use App\Model\SysArea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SysAreaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $provinces = SysArea::provinces();
//        dd($provinces);
        $this->assertTrue(count($provinces)===31) ;

        $with_country_provinces = SysArea::provinces(true);
//        dd($with_country_provinces);
        $this->assertTrue(count($with_country_provinces)===32) ;


        $province = SysArea::first();
//        dd($province->subItems()->count());
        self::assertTrue($province->subItems()->count() === 2);



    }
}
