<?php

$router->get("admin/test/{id}/{post}", "HomeController@test");
$router->post("admin/testHandle", "HomeController@testHandle");
