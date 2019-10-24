<?php

use Illuminate\Routing\Router;

require __DIR__."/routes/init_routes.php";

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    require __DIR__."/routes/work_routes.php";
    $router->get('/', 'HomeController@index')->name('admin.home');
});

