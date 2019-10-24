<?php


namespace Tests\Browser\Traits\DummyModuleName;

use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait DummyModuleNameBaseTraitTest{

//    use ConfigTest;


    protected function DummyModuleNameBase(\Closure $callback,$url='',$times=1)
    {
        foreach (range(1, $times) as $item) {
            $this->browse(function (Browser $browser)use($url,$callback){
                $user = $this->DummyModuleNameUser();
//                dump($user);
                $faker = new HuoFaker();
//                dd($user);
                $browser
                    ->loginAs($user,'DummySnakeModuleName');
                $url && $browser->visitAndDelay($url);
                $callback($browser,$faker);
            });
        }
    }


    protected function DummyModuleNameUser()
    {
        $admin_user_model = config('DummySnakeModuleName.database.users_model');

        return $admin_user_model::first();
    }

    protected function DummyModuleNameUrl($url)
    {
        return "DummySnakeModuleName/".$url;
    }


}
