<?php

use Illuminate\Database\Seeder;

class InitTenancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\Base\TenancyUser::all()->isNotEmpty()) {
            dump("Tenancy管理员已存在，不再增加默认管理员");
            return ;
        };
            \App\Models\Base\TenancyUser::truncate();
            \App\Models\Base\TenancyUser::create([
                'username' => 'tenancy',
                'password' => bcrypt('123456ab'),
                'name'     => '超级管理员',
            ]);




        }





}
