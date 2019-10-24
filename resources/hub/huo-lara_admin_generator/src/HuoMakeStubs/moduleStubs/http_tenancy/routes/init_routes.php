<?php

//本路由是替换掉laraveladmin原有的路由


use Encore\Admin\Controllers\AuthController;

//dd(3);
$attributes = [
    'prefix'     => config('tenancy.route.prefix'),
    'middleware' => config('tenancy.route.middleware'),
];

app('router')->group($attributes, function ($router) {

    /* @var \Illuminate\Support\Facades\Route $router */
    $router->namespace('\Encore\Admin\Controllers')->group(function ($router) {

        /* @var \Illuminate\Routing\Router $router */
//        $router->resource('auth/roles', 'RoleController')->names('tenancy.auth.roles');
//        $router->resource('auth/permissions', 'PermissionController')->names('tenancy.auth.permissions');
        $router->resource('auth/menu', 'MenuController', ['except' => ['create']])->names('tenancy.auth.menu');
//        $router->resource('auth/logs', 'LogController', ['only' => ['index', 'destroy']])->names('tenancy.auth.logs');

        $router->post('_handle_form_', 'HandleController@handleForm')->name('tenancy.handle-form');
        $router->post('_handle_action_', 'HandleController@handleAction')->name('tenancy.handle-action');
    });

    $authController = config('tenancy.auth.controller', AuthController::class);

    /* @var \Illuminate\Routing\Router $router */
    $router->get('auth/login', $authController.'@getLogin')->name('tenancy.login');
    $router->post('auth/login', $authController.'@postLogin');
    $router->get('auth/logout', $authController.'@getLogout')->name('tenancy.logout');
    $router->get('auth/setting', $authController.'@getSetting')->name('tenancy.setting');
    $router->put('auth/setting', $authController.'@putSetting');






    $router->group(['namespace' => "Huojunhao\LaraAdmin\BaseExtends\Plugins"],function(\Illuminate\Routing\Router $router){



//        日志
        /* @var \Illuminate\Routing\Router $router */
        $router->get('logs', 'Log\LogController@index')->name('log-viewer-index');
        $router->get('logs/{file}', 'Log\LogController@index')->name('log-viewer-file');
        $router->get('logs/{file}/tail', 'Log\LogController@tail')->name('log-viewer-tail');


//        数据库
        $router->get('mysqlBackup/mysqlToHtml', 'Mysql\MysqlBackupController@mysqlToHtml');
        $router->get("mysqlBackup/download/{name}","Mysql\MysqlBackupController@download") ;
        $router->post("mysqlBackup/recover","Mysql\MysqlBackupController@recover") ;
        $router->post("mysqlBackup/del","Mysql\MysqlBackupController@del") ;
        $router->any("mysqlBackup/backup","Mysql\MysqlBackupController@backup") ;
        $router->resource("mysqlBackup", Mysql\MysqlBackupController::class)->except(['show']);

//        配置
        /* @var \Illuminate\Routing\Router $router */
        $router->resource(
            config('tenancy.extensions.config.name', 'configs'),
            config('tenancy.extensions.config.controller', 'Config\ConfigController')
        );


    });


    $router->group(['namespace' => config('tenancy.route.namespace')],function(\Illuminate\Routing\Router $router){


//


    });





});
