<?php
namespace Huojunhao\LaraAdmin\BaseExtends\Plugins\PluginTestTraits;
use Huojunhao\LaraAdmin\BaseExtends\AdminSelector;
use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait ConfigTest{


    protected function helpPluginConfigForm(Browser &$browser,HuoFaker $faker)
    {
        $browser->type('name', $faker->word())
            ->type('value', "测试值")
            ->type("description", "测试介绍")
            ->clickAndDelay(AdminSelector::formSubmitBtn())
        ;
        return $this;

    }


    protected function assertPluginConfigIsIndex(Browser &$browser)
    {
        $browser
            ->assertSeeIn(".content-header","配置项管理")
            ->assertSeeIn(".content-header","列表");
        return $this;
    }



    /**
     *
     * @group only_view
     */
    public function testPluginConfigIndex(\Closure $callback = null)
    {
        $this->pluginBase(function(Browser $browser,HuoFaker $faker)use($callback){
            $this->assertPluginConfigIsIndex($browser);
            if ($callback) {
                $callback($browser,$faker);
            }
        },$this->pluginUrl('configs'));
    }


    public function testPluginConfigCreate()
    {
        $this->testPluginConfigIndex(function(Browser $browser,HuoFaker $faker){
            $browser->clickAndDelay(AdminSelector::createBtn());
            $this
                ->helpPluginConfigForm($browser,$faker)
                ->assertPluginConfigIsIndex($browser);
            ;
        });
    }


    public function testPluginConfigEdit()
    {

        $this->testPluginConfigIndex(function(Browser $browser,HuoFaker $faker){
            $browser->clickAndDelay(AdminSelector::editBtn());
            $this->helpPluginConfigForm($browser,$faker)
                ->assertPluginConfigIsIndex($browser);

        });
    }

    public function testPluginConfigDelete()
    {

        $this->testPluginConfigIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::deleteBtn())
                ->clickAndDelay(AdminSelector::swalConfirmBtn())
                ->delay(2)
                ->assertSee("删除成功")
            ;
            $this->assertPluginConfigIsIndex($browser);
        });
    }


    /**
     *
     * @group only_view
     */
    public function testPluginConfigShow()
    {

        $this->testPluginConfigIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::showBtn())
                ->assertPresent(AdminSelector::showPanel())
                ->clickAndDelay(AdminSelector::showPanelListBtn())
                ->delay(1)
            ;
            $this->assertPluginConfigIsIndex($browser);
        });
    }








}
