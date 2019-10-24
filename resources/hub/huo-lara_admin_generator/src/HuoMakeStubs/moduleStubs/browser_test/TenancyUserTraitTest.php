<?php


namespace Tests\Browser\Traits\Tenancy;

use Huojunhao\LaraAdmin\BaseExtends\AdminSelector;
use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait TenancyUserTraitTest{


    protected function helpTenancyTenancyUserForm(Browser &$browser,HuoFaker $faker)
    {
        $browser->type('name', $faker->word())
            ->type('username', $faker->word())
            ->type("password", "123456ab")
            ->type("password_confirmation", "123456ab")
            ->clickAndDelay(AdminSelector::formSubmitBtn())
        ;
        return $this;

    }


    protected function assertTenancyTenancyUserIsIndex(Browser &$browser)
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
    public function testTenancyTenancyUserIndex(\Closure $callback = null)
    {
        $this->TenancyBase(function(Browser $browser,HuoFaker $faker)use($callback){
            $this->assertTenancyTenancyUserIsIndex($browser);
            if ($callback) {
                $callback($browser,$faker);
            }
        },$this->TenancyUrl('auth/users'));
    }


    public function testTenancyTenancyUserCreate()
    {
        $this->testTenancyTenancyUserIndex(function(Browser $browser,HuoFaker $faker){
            $browser->clickAndDelay(AdminSelector::createBtn());
            $this
                ->helpTenancyTenancyUserForm($browser,$faker)
                ->assertTenancyTenancyUserIsIndex($browser);
            ;
        });
    }


    public function testTenancyTenancyUserEdit()
    {

        $this->testTenancyTenancyUserIndex(function(Browser $browser,HuoFaker $faker){
            $browser->clickAndDelay(AdminSelector::editBtn(true));
            $this->helpTenancyTenancyUserForm($browser,$faker)
                ->assertTenancyTenancyUserIsIndex($browser);

        });
    }

    public function testTenancyTenancyUserDelete()
    {

        $this->testTenancyTenancyUserIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::deleteBtn(true))
                ->clickAndDelay(AdminSelector::swalConfirmBtn())
                ->delay(2)
                ->assertSee("删除成功")
            ;
            $this->assertTenancyTenancyUserIsIndex($browser);
        });
    }


    /**
     *
     * @group only_view
     */
    public function testTenancyTenancyUserShow()
    {

        $this->testTenancyTenancyUserIndex(function(Browser $browser,HuoFaker $faker){
            $browser
                ->clickAndDelay(AdminSelector::showBtn(true))
                ->assertPresent(AdminSelector::showPanel())
                ->clickAndDelay(AdminSelector::showPanelListBtn())
                ->delay(1)
            ;
            $this->assertTenancyTenancyUserIsIndex($browser);
        });
    }



}
