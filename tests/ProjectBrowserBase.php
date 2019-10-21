<?php

namespace Tests;


use Laravel\Dusk\Browser;

class ProjectBrowserBase extends DuskTestCase
{


    /**
     * @group duskresult
     * @throws \Throwable
     */
    public function testBrowserDuskResult()
    {
        $this->browse(function(Browser $browser) {
            $browser->visitAndDelay("/testduskdox.html")
                ->delay(5);

        });
    }



}
