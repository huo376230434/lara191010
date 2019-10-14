<?php


/** @var  Illuminate\Routing\Router $router */
$router->resource('auth/users', 'Base\\AdminUserController')->names('admin.auth.users');

$router->resource('posts', TestController::class);



