<?php

use App\Models\User;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Illuminate\Database\Seeder;

class InitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Administrator::all()->isNotEmpty()) {
            dump("管理员已存在，不再增加默认管理员");
            return ;
        };
            Administrator::truncate();
            Administrator::create([
                'username' => 'admin',
                'password' => bcrypt('123456ab'),
                'name'     => '超级管理员',
            ]);




        }





}
