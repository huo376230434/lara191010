<?php


namespace Tests\Browser\Traits\Tenancy;

use Huojunhao\LaraAdmin\BaseExtends\AdminSelector;
use Huojunhao\LibDev\Faker\HuoFaker;
use Laravel\Dusk\Browser;

trait AuthTraitTest{


    protected function helpTenancyTenancyLoginForm(Browser &$browser,HuoFaker $faker)
    {
        $browser
            ->type('username', 'tenancy')
            ->type("password", "123456ab")
            ->clickAndDelay(AdminSelector::simpleSubmitBtn())
        ;
        return $this;

    }


    protected function assertTenancyLoginIsFirstPage(Browser &$browser)
    {
        $browser
            ->assertSeeIn(".content-header","Dashboard");
        return $this;
    }



    /**
     *
     * @group only_view
     */
    public function testTenancyAuthLogin()
    {
        $this->browse(function(Browser $browser){
            $browser->visitAndDelay($this->TenancyUrl('auth/login'));
            $this
                ->helpTenancyTenancyLoginForm($browser,new HuoFaker());
            $browser->delay(1);
            $this->assertTenancyLoginIsFirstPage($browser)
            ;
        });
    }



}
