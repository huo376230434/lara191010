<?php

use Illuminate\Database\Seeder;

class InitAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable("DummyAreaTable") && !DB::table('DummyAreaTable')->first()){
            //表存在 且表为空,才执行

            $content = file(database_path("seeds/area_data/area.csv"));
//            $content = file(database_path("seeds/sql_res/area_simple.csv"));
//            $content = file(database_path("seeds/sql_res/area_no_district.csv"));
            $data = [];

            foreach ($content as $k => $item) {
                $item = trim($item);

                if (!$item) {
                    //空行跳出
                    continue;
                }
                [$id, $name, $parent_id, $node_id, $code] = explode(",", $item);

                $data[] = [
                    'id' => trim( $id,'"'),
                    'name' => trim( $name,'"'),
                    'parent_id' => trim( $parent_id,'"'),
                    'node_id' => trim( $node_id,'"'),
                    'code' => trim($code,'"')
                ];//这些字段即为表结构

            }
//            dd(1);

            DB::table("DummyAreaTable")->insert($data);
        }
        //
    }
}
