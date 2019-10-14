<?php

use Faker\Generator as Faker;
use Huojunhao\LibDev\Faker\HuoFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    $huo_faker = new Huofaker();
    return [
        'title' => 
    Str::random(rand(10,30))
,

'content' => 
    $huo_faker->note()
,
'created_at' => 
    $faker->dateTimeBetween("-1 month")
,

'updated_at' => 
    $faker->dateTimeBetween("-1 month")
    ];
});
