<?php

namespace Huojunhao\Lib\ZtestTraits\Base;


use Huojunhao\Lib\Base\Curl;
use Huojunhao\Lib\Base\FormatConversion;

trait CurlTest
{


    /**
     *
     * @group Common
     * @throws \Exception
     */
    public function testPost()
    {
        $res = Curl::post("https://www.apiopen.top/weatherApi",['city' => "深圳"]);
        $res = FormatConversion::jsonDecode($res);
        dd($res);
        $this->assertArrayHasKey('code', $res);
    }


    /**
     * @group Common
     * @throws \Exception
     */
    public function testGet()
    {
        $res = Curl::get("https://www.baidu.com");

        $this->assertContains("baidu.com",$res.'');
    }

}
