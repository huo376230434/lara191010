<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ZDevOnlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "devonly";
//        if(!env('IS_DEV')){
//            echo "不是开发模式，不执行 InitDevOnlySeeder ,若要执行，请在env文件中把 IS_DEV设置为true";
//            return ;
//        }
//
//        if ( !DB::table("u_users")->where("id", 1)->exists()) {
//
//            $unit_org = new \App\Model\UOrganization([
//                'id' => 1,
//                'name' => "单位测试",
//                'sys_unit_type_id' => 6,
//                'state' => 1,
//                'manage_account_id' => 1
//            ]);
//            $unit_org->save();
//            $agency_org = new \App\Model\UOrganization([
//                'id' => 2,
//                'name' => "机构测试",
//                'sys_unit_type_id' => 5,
//                'state' => 1,
//                'manage_account_id' => 2
//
//            ]);
//            $agency_org->save();
////            $project = new \App\Model\PProject([
////                'id' => 1,
////                'name' => '测试项目',
////                'launch_organization_id' => 1,
////                'reserved_organization_id' => 2,
////                'p_project_status' => 3
////            ]);
////            $project->save();
//
//
//
//
//            dump("插入u_users测试数据");
//
//
//            $this->addUser($unit_org, [
//                'id' => 1,
//                'account' => 'unit',
//                'nickname' => '单位管理员',
//                'sys_unit_type_id' => 6,
//
//            ]);
//
//
//            $this->addUser($agency_org, [
//                'id' => 2,
//                'account' => 'agency',
//                'nickname' => '机构管理员',
//                'sys_unit_type_id' => 5,
//
//            ]);
//
//            foreach (range(1,9) as $key => $value) {
//
//                $this->addUser($unit_org, [
////                    'id' => 1,
//                    'account' => 'unit_worker_'.$key,
//                    'nickname' => '测试单位员工'.$key,
//                    'sys_unit_type_id' => 6,
//
//                ]);
//
//                $this->addUser($agency_org, [
////                    'id' => 1,
//                    'account' => 'agency_worker_'.$key,
//                    'nickname' => '测试机构员工'.$key,
//                    'sys_unit_type_id' => 5,
//
//                ]);
//
//            }
//
//            $this->addSubType();
//
//
//        }
//    }
//
//
//    protected function addSubType()
//    {
//      $arr =   [
//            "行业" => [
//                ['id' => 1, "name" => "水利"],
//                ['id' => 2, "name" => "地理"],
//                ['id' => 3, "name" => "财务"],
//                ['id' => 4, "name" => "土木"]
//            ],
//
//            '业务' =>[
//                ['id' => 1, "name" => "预算管理"],
//                ['id' => 2, "name" => "支出管理"],
//                ['id' => 3, "name" => "合同管理"],
//            ],
//        ];
//        //        添加标准库索引
//
//        foreach ($arr as $key =>  $item) {
//            $parent = new SysDocIndexType([
//                'type_name' => $key,
//                'org_flag' => 1
//            ]);
//            $parent->save();
//            foreach ($item as $sub_item) {
//                $obj = new SysDocIndexTypeList([
//                    'name' => $sub_item['name'],
//                    'sys_doc_indextype_id' => $parent->id,
//                    'parent_id' => 0,
//                    'node_id' => 0
//                ]);
//                $obj->save();
//            }
//        }
//    }
//
//
//    protected function addUser($org,$data=[])
//    {
//        $default_data = [
////            'id' => rand(1,999),
//            'account' => 'agency',
//            'nickname' => '机构管理员',
//            'email' => Str::uuid()."@qq.com",
//
////                    'parent_id' => 0,
////                    'node_id' => 0,
//            'password' => bcrypt('123456ab'),
//            'state' => 2,
//            'sys_unit_type_id' => 5,
//            'u_organization_id' => $org->id,
//            'email_verified_at' => date('Y-m-d H:i:s')
//        ];
//        $data = array_merge($default_data, $data);
//
//
//        $user = new \App\Model\UUser($data);
//        $user->save();
//        $user->uUnitUserLists()->save(new \App\Model\UUnitUserList([
//            'sys_unit_type_id' =>$data['sys_unit_type_id'],
//            'unit_id' =>  $org->id,
//            'sys_application_state_id' => 2
//
//        ]));



    }
}
