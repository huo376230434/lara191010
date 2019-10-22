<?php

use Huojunhao\Lib\Base\FileUtil;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->initSeed();
        $this->call(ZDevOnlySeeder::class);

    }


    public function initSeed()
    {
        //获得seeds下所有Init开头的类
        $init_arr = FileUtil::allFileWithoutDir(database_path("seeds"));
        $init_arr =\Illuminate\Support\Arr::where($init_arr,function($value,$key){
            return \Illuminate\Support\Str::startsWith($value,"Init");
        });
        $init_arr = array_map(function($value){
            return rtrim($value,".php");
        },$init_arr);

        foreach ($init_arr as $item) {
            $this->call($item);
        }
    }


}
