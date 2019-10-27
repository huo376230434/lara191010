<?php

$router->get("homes/test/{id}/{post}", "HomeController@test");

$router->post("homes/test_handle", "HomeController@testHandle");

$router->any("ha_tes/tt", "HaTeController@tt");

$router->any("ha_tes/test", "HaTeController@test");

$router->any("ha_tes/view", "HaTeController@view");

