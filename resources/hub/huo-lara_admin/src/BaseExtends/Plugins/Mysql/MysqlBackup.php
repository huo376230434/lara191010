<?php

namespace Huojunhao\LaraAdmin\BaseExtends\Plugins\Mysql;

use Huojunhao\Lib\Base\FileUtil;
use Huojunhao\Lib\Database\MysqlMaintenance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class MysqlBackup extends Model
{
    //

    protected function getDataFromFiles()
    {
//        取得数据库数组

        $backup_path = MysqlMaintenance::obj()->getBackupPath();
        $files = FileUtil::allFileWithAttrs($backup_path, true);
        $files = collect($files)->reject((function ($value,$key){
                    return    Str::startsWith($value['name'],".");
        }))->toArray();
      //  dd($files);
      return $files ;



    }


    /**
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public function paginate()
    {
        $perPage = Request::get('per_page', 20);

        $page = Request::get('page', 1);

        $start = ($page-1)*$perPage;


        $data = $this->getDataFromFiles();

        $model_data = static::hydrate($data);
        $total = count($data);

//      让data按时间倒序排列

        $model_data = $model_data->sortByDesc('filemtime')->forPage($page,$perPage);


        $paginator = new LengthAwarePaginator($model_data, $total, $perPage);

        $paginator->setPath(url()->current());

        return $paginator;
    }

    public static function with($relations)
    {
        return new static;
    }

}
