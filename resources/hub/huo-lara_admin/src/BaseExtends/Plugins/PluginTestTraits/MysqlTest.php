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

trait MysqlTest{





    protected function assertPluginMysqlIsIndex(Browser &$browser)
    {
        $browser
            ->assertSeeIn(".content-header","数据库管理")
            ->assertSeeIn(".content-header","列表");
        return $this;
    }


    /**
     * @param \Closure|null $callback
     * @group only_view
     */
    public function testPluginMysqlIndex(\Closure $callback = null)
    {
        $this->pluginBase(function(Browser $browser,HuoFaker $faker)use($callback){
            $this->assertPluginMysqlIsIndex($browser);
            if ($callback) {
                $callback($browser,$faker);
            }
        },$this->pluginUrl('mysqlBackup'));
    }


    public function testPluginMysqlCreate()
    {
        $this->testPluginMysqlIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay("[title=\"确定添加备份?\"]")
            ->clickAndDelay(AdminSelector::swalConfirmBtn())
            ->delay(1)
            ->assertSeeIn(AdminSelector::swalTitle(),"添加成功");
            $this->assertPluginMysqlIsIndex($browser);
            ;
        });
    }

    /**
     *
     * @group only_view
     */
    public function testPluginMysqlDatabaseDoc()
    {
        $this->testPluginMysqlIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay("[title=\"查看字典文档\"]");
            $browser->switchToNewWindow()
                ->assertSee("数据库字典文档")
                ->switchToBackWindow()
            ;
            $this->assertPluginMysqlIsIndex($browser);

        });
    }

    /**
     *
     * @group only_view
     */
    public function testPluginMysqlDownload()
    {
        $this->testPluginMysqlIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndAssertDownload(AdminSelector::gridActionBtn("[title=\"下载\"]"))

            ;
        });
    }


    public function testPluginMysqlDelete()
    {

        $this->testPluginMysqlIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::deleteBtn())
                ->clickAndDelay(AdminSelector::swalConfirmBtn())
                ->delay(2)
                ->assertSee("删除成功")

            ;
            $this->assertPluginMysqlIsIndex($browser);
        });
    }


}
