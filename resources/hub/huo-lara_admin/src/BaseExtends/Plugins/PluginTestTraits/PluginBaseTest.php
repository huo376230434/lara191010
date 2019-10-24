<?php
namespace Huojunhao\LaraAdmin\BaseExtends\Plugins\PluginTestTraits;
use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019-10-17
 * Time: 16:32
 */

trait PluginBaseTest{
    use ConfigTest,LogTest,MysqlTest;


    protected function pluginBase(\Closure $callback,$url='',$times=1)
    {
        foreach (range(1, $times) as $item) {
            $this->browse(function (Browser $browser)use($url,$callback){
                $user = $this->pluginUser();
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


    protected function pluginUser()
    {
        $admin_user_model = config('admin.database.users_model');

        return $admin_user_model::first();
    }

    protected function pluginUrl($url)
    {
        return "admin/".$url;
    }

}
