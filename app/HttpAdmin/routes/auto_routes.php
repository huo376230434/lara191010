<?php

$router->get("homes/test/{id}/{post}", "HomeController@test");

$router->post("homes/test_handle", "HomeController@testHandle");

