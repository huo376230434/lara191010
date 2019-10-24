<?php

namespace Huojunhao\Lib\Utils;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 16:35
 */

class MigrateUtil{


    public static function migrateTableComment($table,$comment)
    {
        DB::statement("ALTER TABLE $table comment '$comment' ");//表注释

    }

}
