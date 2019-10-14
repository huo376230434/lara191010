<?php

use App\Models\User;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Illuminate\Database\Seeder;

class InitMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


            // add default menus.
            Menu::truncate();
            Menu::insert([

                [
                    'parent_id' => 0,
                    'order'     => 3,
                    'title'     => '管理员管理',
                    'icon'      => 'fa-users',
                    'uri'       => 'auth/users',
                ],
//                [
//                    'parent_id' => 0,
//                    'order'     => 3,
//                    'title'     => '查询订单管理',
//                    'icon'      => 'fa-list',
//                    'uri'       => 'posts',
//                ]
            ]);

        }

}
