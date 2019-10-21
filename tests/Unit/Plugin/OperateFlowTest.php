<?php

namespace Tests\Unit\Plugin;

use App\Models\Base\AdminUser;
use App\Models\OperateFlow;
use Illuminate\Support\Str;
use Tests\TestCase;

class OperateFlowTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $msg = "测试日志记录" . time();
        $this->actingAs(AdminUser::first(),'admin');
        \App\Models\OperateFlow::log($msg);
        $inserted_msg = OperateFlow::latest()->first()->message;
        $this->assertTrue(Str::contains($inserted_msg,$msg));
    }
}
