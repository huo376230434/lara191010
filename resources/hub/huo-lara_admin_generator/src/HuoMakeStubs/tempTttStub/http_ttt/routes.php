<?php

use Illuminate\Routing\Router;

require __DIR__."/routes/init_routes.php";
//echo 44;die;
Route::group([
    'prefix'        => config('tenancy.route.prefix'),
    'namespace'     => config('tenancy.route.namespace'),
    'middleware'    => config('tenancy.route.middleware'),
], function (Router $router) {
    require __DIR__."/routes/work_routes.php";
    $router->get('/', 'HomeController@index')->name('tenancy.home');

});
