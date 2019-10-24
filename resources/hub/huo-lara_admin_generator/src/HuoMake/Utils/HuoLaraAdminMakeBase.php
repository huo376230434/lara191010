<?php
namespace Huojunhao\LaraAdminGenerator\HuoMake\Utils;

use Huojunhao\Generator\HuoMake\Utils\HuoMakeBase;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 18:44
 */
abstract  class HuoLaraAdminMakeBase extends HuoMakeBase {

    protected function getBaseStubDir()
    {
        return __DIR__ . '/../../HuoMakeStubs';

//        return storage_path('/stubs/HuoMakeStubs');
    }


    protected function getBaseGeneratorSrcDir()
    {
        return __DIR__ . '/../src/';
    }


}
