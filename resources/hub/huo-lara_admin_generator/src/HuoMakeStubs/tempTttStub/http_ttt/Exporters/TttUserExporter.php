<?php
namespace App\HttpTenancy\Exporters;
use Encore\Admin\Grid\Exporters\ExcelExporter;

/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019-09-10
 * Time: 16:00
 */

class TenancyUserExporter extends ExcelExporter
//    implements WithMapping
{

    protected $fileName = '管理员列表.xlsx';

    protected $columns = [
        'id'                    => 'ID',
        'username'                  => '登录账号',
        'name'                  => '姓名',
        'created_at'                => '创建时间',
//        'profile.homepage'      => '主页',
    ];

//    protected $headings = [
////
////    ];

    /**
     * @param mixed $row
     *
     * @return array
     */
//    public function map($row): array
//    {
//        // TODO: Implement map() method.
//    }
}
