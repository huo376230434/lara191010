<?php


//dd(5);
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

if (!function_exists("huoseed")) {
    function huoseed($params)
    {
//        ini_set("memory_limit", "-1");
        [$model,$number] = array_pad(explode("-", $params,2),2,6);
        dump($model.' - '.$number);
        $model = "App\Models\\" . ucfirst($model);
//        dump($model);
        factory($model,(int)$number)->create();
    }
}

if (!function_exists("huoseedAll")) {
    /**
     * @param bool $append 是否追加
     */
    function huoseedAll($append=false)
    {
        $seeds = require resource_path('quickdev/factory/aatotal_config.php');
        foreach ($seeds as $item) {
            $table_name =  \Illuminate\Support\Str::plural(Str::snake($item['item']));
            if( DB::table($table_name)->get()->isNotEmpty() && !$append){
                continue;
            }
            if ($item['ignore'] == true) {
                continue;
            }
            huoseed($item['item'] . "-" . $item['num']);
        }
    }
}
