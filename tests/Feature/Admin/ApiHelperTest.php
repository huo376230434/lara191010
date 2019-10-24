<?php

namespace Tests\Feature\Admin;

use App\Models\Base\AdminUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiHelperTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $url = config('admin.route.prefix')."/apihelper/BaseModel/testVisitView/1";
        $response = $this->actingAs(AdminUser::first(),"admin") ->get($url);
        dump($response->exception);
        $response->assertStatus(200);
    }
}
