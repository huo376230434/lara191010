<?php


/** @var  Illuminate\Routing\Router $router */
$router->resource('auth/users', 'AdminUserController')->names('admin.auth.users');





$router->resource('posts', PostController::class);
