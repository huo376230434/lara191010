<?php

namespace Tests\Browser;


use Huojunhao\LaraAdmin\BaseExtends\Plugins\PluginTestTraits\PluginBaseTest;
use Tests\Browser\Traits\Admin\AdminBaseTraitTest;
use Tests\Browser\Traits\Merchant\MerchantBaseTraitTest;
use Tests\ProjectBrowserBase;

class DevTest
    extends ProjectBrowserBase
{
    use PluginBaseTest,AdminBaseTraitTest,MerchantBaseTraitTest;



}
