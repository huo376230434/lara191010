<?php


namespace Tests\Browser\Traits\DummyModuleName;

use Huojunhao\LaraAdmin\BaseExtends\AdminSelector;
use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait DummySimpleNameTraitTest{


    protected function helpDummyModuleNameDummySimpleNameForm(Browser &$browser,HuoFaker $faker)
    {
        $browser
            //TestForm

//            ->select('size', 'Large')
//            ->attach('photo', __DIR__.'/photos/me.png')
            ->clickAndDelay(AdminSelector::formSubmitBtn())
        ;
        return $this;

    }


    protected function assertDummyModuleNameDummySimpleNameIsIndex(Browser &$browser)
    {
        $browser
            ->assertSeeIn(".content-header","DummyTitle")
            ->assertSeeIn(".content-header","列表");
        return $this;
    }



    /**
     *
     * @group only_view
     */
    public function testDummyModuleNameDummySimpleNameIndex(\Closure $callback = null)
    {
        $this->DummyModuleNameBase(function(Browser $browser,HuoFaker $faker)use($callback){
            $this->assertDummyModuleNameDummySimpleNameIsIndex($browser);
            if ($callback) {
                $callback($browser,$faker);
            }
        },$this->DummyModuleNameUrl('DummyRouteName'));
    }


    public function testDummyModuleNameDummySimpleNameCreate()
    {
        $this->testDummyModuleNameDummySimpleNameIndex(function(Browser $browser,HuoFaker $faker){
            $browser->clickAndDelay(AdminSelector::createBtn());
            $this
                ->helpDummyModuleNameDummySimpleNameForm($browser,$faker)
                ->assertDummyModuleNameDummySimpleNameIsIndex($browser);
            ;
        });
    }


    public function testDummyModuleNameDummySimpleNameEdit()
    {

        $this->testDummyModuleNameDummySimpleNameIndex(function(Browser $browser,HuoFaker $faker){
            $browser->clickAndDelay(AdminSelector::editBtn());
            $this->helpDummyModuleNameDummySimpleNameForm($browser,$faker)
                ->assertDummyModuleNameDummySimpleNameIsIndex($browser);

        });
    }

    public function testDummyModuleNameDummySimpleNameDelete()
    {

        $this->testDummyModuleNameDummySimpleNameIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::deleteBtn())
                ->clickAndDelay(AdminSelector::swalConfirmBtn())
                ->delay(2)
                ->assertSee("删除成功")
            ;
            $this->assertDummyModuleNameDummySimpleNameIsIndex($browser);
        });
    }


    /**
     *
     * @group only_view
     */
    public function testDummyModuleNameDummySimpleNameShow()
    {

        $this->testDummyModuleNameDummySimpleNameIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::showBtn())
                ->assertPresent(AdminSelector::showPanel())
                ->clickAndDelay(AdminSelector::showPanelListBtn())
                ->delay(1)
            ;
            $this->assertDummyModuleNameDummySimpleNameIsIndex($browser);
        });
    }








}
