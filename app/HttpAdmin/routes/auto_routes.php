<?php
$router->any("admin/index/{content}", "HomeController@index");
$router->any("admin/test", "HomeController@test");
$router->any("admin/testHandle", "HomeController@testHandle");
$router->any("admin/form", "AdminUserController@form");
