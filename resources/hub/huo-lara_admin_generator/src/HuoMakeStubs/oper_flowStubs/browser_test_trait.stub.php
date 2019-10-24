<?php


namespace Tests\Browser\Traits\DummyModule;

use Huojunhao\LaraAdmin\BaseExtends\AdminSelector;
use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait DummyModelTraitTest{




    protected function assertDummyModuleDummyModelIsIndex(Browser &$browser)
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
    public function testDummyModuleDummyModelIndex(\Closure $callback = null)
    {
        $this->DummyModuleBase(function(Browser $browser,HuoFaker $faker)use($callback){
            $this->assertDummyModuleDummyModelIsIndex($browser);
            if ($callback) {
                $callback($browser,$faker);
            }
        },$this->DummyModuleUrl('DummyTable'));
    }


    public function testDummyModuleDummyModelDelete()
    {

        $this->testDummyModuleDummyModelIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::deleteBtn())
                ->clickAndDelay(AdminSelector::swalConfirmBtn())
                ->delay(2)
                ->assertSee("删除成功")
            ;
            $this->assertDummyModuleDummyModelIsIndex($browser);
        });
    }


}
