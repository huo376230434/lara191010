<?php
/**
 * 自动生成时间  2019-10-26 19:01
 */
namespace Tests\Unit\Services;

use App\Services\PostService;
use Tests\TestCase;

class PostTest extends TestCase {
        
        // 自动生成时间  2019-10-26 19:01
 public function testIndex()
    {
        $service = new PostService();
        $res = $service->index();
        $this->assertTrue($res);
        
    }
        
        // 自动生成时间  2019-10-26 19:01
 public function testTest()
    {
        $service = new PostService();
        $res = $service->test();
        $this->assertTrue($res);
        
    }
        
        // 自动生成时间  2019-10-26 19:01
 public function testAddd()
    {
        $service = new PostService();
        $res = $service->addd();
        $this->assertTrue($res);
        
    }


}
