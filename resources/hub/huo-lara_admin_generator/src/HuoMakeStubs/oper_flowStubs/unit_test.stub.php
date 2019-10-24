<?php

namespace Tests\Unit\Plugins;

use App\Models\DummyModel;
use Illuminate\Support\Str;
use Tests\TestCase;

class DummyModelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $msg = "测试日志记录" . time();
        $this->actingAs(\App\Models\DummyUserModel::first(),'admin');
        DummyModel::log($msg);
        $inserted_msg = DummyModel::latest()->first()->message;
        $this->assertTrue(Str::contains($inserted_msg,$msg));
    }
}
