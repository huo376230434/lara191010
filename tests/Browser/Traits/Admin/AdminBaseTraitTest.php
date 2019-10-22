<?php


namespace Tests\Browser\Traits\Admin;

use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait AdminBaseTraitTest{

//    use SysOperateLogTraitTest;


    protected function AdminBase(\Closure $callback,$url='',$times=1)
    {
        foreach (range(1, $times) as $item) {
            $this->browse(function (Browser $browser)use($url,$callback){
                $user = $this->AdminUser();
//                dump($user);
                $faker = new HuoFaker();
//                dd($user);
                $browser
                    ->loginAs($user,'admin');
                $url && $browser->visitAndDelay($url);
                $callback($browser,$faker);
            });
        }
    }


    protected function AdminUser()
    {
        $admin_user_model = config('admin.database.users_model');

        return $admin_user_model::first();
    }

    protected function AdminUrl($url)
    {
        return "admin/".$url;
    }


}
