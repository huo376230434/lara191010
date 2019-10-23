<?php


namespace Tests\Browser\Traits\Admin;

use Huojunhao\LaraAdmin\BaseExtends\AdminSelector;
use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait AdminUserTraitTest{


    protected function helpAdminAdminUserForm(Browser &$browser,HuoFaker $faker)
    {
        $browser->type('name', $faker->word())
            ->type('username', $faker->word())
            ->type("password", "123456ab")
            ->type("password_confirmation", "123456ab")
            ->clickAndDelay(AdminSelector::formSubmitBtn())
        ;
        return $this;

    }


    protected function assertAdminAdminUserIsIndex(Browser &$browser)
    {
        $browser
            ->assertSeeIn(".content-header","管理员管理")
            ->assertSeeIn(".content-header","列表");
        return $this;
    }



    /**
     *
     * @group only_view
     */
    public function testAdminAdminUserIndex(\Closure $callback = null)
    {
        $this->AdminBase(function(Browser $browser,HuoFaker $faker)use($callback){
            $this->assertAdminAdminUserIsIndex($browser);
            if ($callback) {
                $callback($browser,$faker);
            }
        },$this->AdminUrl('auth/users'));
    }


    public function testAdminAdminUserCreate()
    {
        $this->testAdminAdminUserIndex(function(Browser $browser,HuoFaker $faker){
            $browser->clickAndDelay(AdminSelector::createBtn());
            $this
                ->helpAdminAdminUserForm($browser,$faker)
                ->assertAdminAdminUserIsIndex($browser);
            ;
        });
    }


    public function testAdminAdminUserEdit()
    {

        $this->testAdminAdminUserIndex(function(Browser $browser,HuoFaker $faker){
            $browser->clickAndDelay(AdminSelector::editBtn(true));
            $this->helpAdminAdminUserForm($browser,$faker)
                ->assertAdminAdminUserIsIndex($browser);

        });
    }

    public function testAdminAdminUserDelete()
    {

        $this->testAdminAdminUserIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::deleteBtn(true))
                ->clickAndDelay(AdminSelector::swalConfirmBtn())
                ->delay(2)
                ->assertSee("删除成功")
            ;
            $this->assertAdminAdminUserIsIndex($browser);
        });
    }


    /**
     *
     * @group only_view
     */
    public function testAdminAdminUserShow()
    {

        $this->testAdminAdminUserIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::showBtn(true))
                ->assertPresent(AdminSelector::showPanel())
                ->clickAndDelay(AdminSelector::showPanelListBtn())
                ->delay(1)
            ;
            $this->assertAdminAdminUserIsIndex($browser);
        });
    }



}
