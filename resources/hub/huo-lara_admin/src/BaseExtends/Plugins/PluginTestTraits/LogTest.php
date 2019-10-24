<?php
namespace Huojunhao\LaraAdmin\BaseExtends\Plugins\PluginTestTraits;
use Huojunhao\LaraAdmin\BaseExtends\AdminSelector;
use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019-10-17
 * Time: 16:32
 */

trait LogTest{



    protected function assertPluginLogIsIndex(Browser &$browser)
    {
        $browser
            ->assertSeeIn(".content-header","日志管理");
//            ->assertSeeIn(".content-header","列表");
        return $this;
    }


    /**
     * @param \Closure|null $callback
     * @group only_view
     */
    public function testPluginLogIndex(\Closure $callback = null)
    {
        $this->pluginBase(function(Browser $browser,HuoFaker $faker)use($callback){
            $this->assertPluginLogIsIndex($browser);
            if ($callback) {
                $callback($browser,$faker);
            }
        },$this->pluginUrl('logs'));
    }






}
