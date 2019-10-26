<?php


namespace Tests\Feature\Traits\Admin;

use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait AdminBaseTraitTest{

    use ApiHelperTraitTest;


    protected function AdminBase()
    {
        $this->actingAs($this->AdminUser(),"admin");

    }


    protected function AdminUser()
    {
        $admin_user_model = config('admin.database.users_model');
        return $admin_user_model::first();
    }

    protected function AdminUrl($url)
    {
        return "/admin/".$url;
    }


}
