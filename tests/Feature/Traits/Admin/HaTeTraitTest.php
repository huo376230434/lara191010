<?php

namespace Tests\Feature\Traits\Admin;

/**
 * 自动生成时间  2019-10-27 19:12
 */
trait HaTeTraitTest
{
   /**
     * 
     * 自动生成时间  2019-10-27 19:12
     */
    public function testAdminHaTeIndex()
    {
        $this->AdminBase();
        $url = $this->AdminUrl('ha_tes/index');

        /** @var \Illuminate\Foundation\Testing\TestResponse $response */
        $response = $this->get($url);

//        dd($response);
        dump($response->exception);
        $response->assertStatus(200);
        $response->assertSee("index");

    }
   /**
     * 
     * 自动生成时间  2019-10-27 19:12
     */
    public function testAdminHaTeTt()
    {
        $this->AdminBase();
        $url = $this->AdminUrl('ha_tes/tt');

        /** @var \Illuminate\Foundation\Testing\TestResponse $response */
        $response = $this->get($url);

//        dd($response);
        dump($response->exception);
        $response->assertStatus(200);
        $response->assertSee("tt");

    }
   /**
     * 
     * 自动生成时间  2019-10-27 19:15
     */
    public function testAdminHaTeTest()
    {
        $this->AdminBase();
        $url = $this->AdminUrl('ha_tes/test');

        /** @var \Illuminate\Foundation\Testing\TestResponse $response */
        $response = $this->get($url);

//        dd($response);
        dump($response->exception);
        $response->assertStatus(200);
        $response->assertSee("test");

    }
    

}
