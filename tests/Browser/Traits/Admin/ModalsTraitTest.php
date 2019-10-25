<?php


namespace Tests\Browser\Traits\Admin;

use Huojunhao\LaraAdmin\BaseExtends\AdminSelector;
use Huojunhao\LibDev\Faker\HuoFaker;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;

trait ModalsTraitTest{


//
    protected function assertModal(Browser &$browser,$failed=true)
    {
        $msg = $failed ? "失败" : "成功";
        $browser
            ->assertSeeIn("#toast-container","测试$msg");
        return $this;
    }
//
    protected function getSnakeModalName($method)
    {
        return Str::snake(explode('testAdminModals',$method)[1]);
    }

    /**
     *
     */
    public function testAdminModalsOperateWithMsg(\Closure $callback = null)
    {
        $snake_mdoal_name = $this->getSnakeModalName(__METHOD__);
        $this->AdminBase(function(Browser $browser,HuoFaker $faker)use($callback,$snake_mdoal_name){
            $browser->clickAndDelay(".$snake_mdoal_name")
                //todo
                ->type("operate_msg","adsf")
                ->clickAndDelay("#$snake_mdoal_name-submit");

            $this->assertModal($browser);
            $browser->clickAndDelay("#$snake_mdoal_name-submit");
            $this->assertModal($browser,false);

        },$this->AdminUrl('modal_tests'));
    }



    public function testAdminModalsOperateWithInput(\Closure $callback = null)
    {
        $snake_mdoal_name = $this->getSnakeModalName(__METHOD__);
        $this->AdminBase(function(Browser $browser,HuoFaker $faker)use($callback,$snake_mdoal_name){
            $browser->clickAndDelay(".$snake_mdoal_name")
                //todo
                ->type('operate_input', $faker->word())
                    ->clickAndDelay("#$snake_mdoal_name-submit");

            $this->assertModal($browser);
            $browser->clickAndDelay("#$snake_mdoal_name-submit");
            $this->assertModal($browser,false);

        },$this->AdminUrl('modal_tests'));
    }

   /**
     * 
     * 自动生成时间  2019-10-25 17:22
     */
    public function testAdminModalsOperTest(\Closure $callback = null)
    {
        $snake_mdoal_name = $this->getSnakeModalName(__METHOD__);
        $this->AdminBase(function(Browser $browser,HuoFaker $faker)use($callback,$snake_mdoal_name){
            $browser->clickAndDelay(".$snake_mdoal_name")
                //todo
                ->clickAndDelay("#$snake_mdoal_name-submit");

            $this->assertModal($browser);
            $browser->clickAndDelay("#$snake_mdoal_name-submit");
            $this->assertModal($browser,false);

        },$this->AdminUrl('modal_tests'));
    }

}
