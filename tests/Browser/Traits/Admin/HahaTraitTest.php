<?php


namespace Tests\Browser\Traits\Admin;

use Huojunhao\LaraAdmin\BaseExtends\AdminSelector;
use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

/**
 * 自动生成时间  2019-10-27 18:51
 */
trait HahaTraitTest{


    /**
     *
     * @group only_view
     */
    public function testAdminHahaView(\Closure $callback = null)
    {
        $this->AdminBase(function(Browser $browser,HuoFaker $faker)use($callback){

            $browser
                //todo
                ->assertSeeIn(AdminSelector::contentWrapper(),"Hate");

        },$this->AdminUrl('ha_tes/view'));
    }


}
