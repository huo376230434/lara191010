<?php

namespace Tests\Feature\Traits\Admin;

trait ApiHelperTraitTest
{
    /**
     * A basic feature test example.
     *
     */
    public function testAdminApiHelper()
    {
        $this->AdminBase();
        $url = $this->AdminUrl('apihelper/BaseModel/testVisitView/1');

        /** @var \Illuminate\Foundation\Testing\TestResponse $response */
        $response = $this->get($url);

//        dd($response);
        dump($response->exception->getMessage());
        $response->assertSee("BaseModel不存在");
        return time();

    }


    /**
     *
     * DummyGeneratorCreateDate
     */
    public function testDummyModuleNameApiHelper()
    {
        $this->AdminBase();
        $url = $this->AdminUrl('apihelper/BaseModel/testVisitView/1');

        /** @var \Illuminate\Foundation\Testing\TestResponse $response */
        $response = $this->get($url);

//        dd($response);
        dump($response->exception->getMessage());
        $response->assertStatus(200);
        $response->assertSee("****不存在");

    }

}
