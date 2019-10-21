<?php


namespace Tests\Browser\Traits\Admin;

use Huojunhao\LaraAdmin\BaseExtends\AdminSelector;
use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait OperateFlowTraitTest{




    protected function assertAdminOperateFlowIsIndex(Browser &$browser)
    {
        $browser
            ->assertSeeIn(".content-header","操作记录管理")
            ->assertSeeIn(".content-header","列表");
        return $this;
    }



    /**
     *
     * @group only_view
     */
    public function testAdminOperateFlowIndex(\Closure $callback = null)
    {
        $this->AdminBase(function(Browser $browser,HuoFaker $faker)use($callback){
            $this->assertAdminOperateFlowIsIndex($browser);
            if ($callback) {
                $callback($browser,$faker);
            }
        },$this->AdminUrl('operate_flows'));
    }


    public function testAdminOperateFlowDelete()
    {

        $this->testAdminOperateFlowIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::deleteBtn())
                ->clickAndDelay(AdminSelector::swalConfirmBtn())
                ->delay(2)
                ->assertSee("删除成功")
            ;
            $this->assertAdminOperateFlowIsIndex($browser);
        });
    }


}
