<?php

use Faker\Generator as Faker;
use Huojunhao\LibDev\Faker\HuoFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

$factory->define(App\Models\DummyModel::class, function (Faker $faker) {
    $huo_faker = new Huofaker();
    return [
        //factoryhook
    ];
});
