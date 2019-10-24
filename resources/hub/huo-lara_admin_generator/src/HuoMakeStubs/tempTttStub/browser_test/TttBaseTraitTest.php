<?php


namespace Tests\Browser\Traits\Tenancy;

use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait TenancyBaseTraitTest{

    use AuthTraitTest,TenancyUserTraitTest;


    protected function TenancyBase(\Closure $callback,$url='',$times=1)
    {
        foreach (range(1, $times) as $item) {
            $this->browse(function (Browser $browser)use($url,$callback){
                $user = $this->TenancyUser();
//                dump($user);
                $faker = new HuoFaker();
//                dd($user);
                $browser
                    ->loginAs($user,'tenancy');
                $url && $browser->visitAndDelay($url);
                $callback($browser,$faker);
            });
        }
    }


    protected function TenancyUser()
    {
        $admin_user_model = config('tenancy.database.users_model');

        return $admin_user_model::first();
    }

    protected function TenancyUrl($url)
    {
        return "tenancy/".$url;
    }


}
