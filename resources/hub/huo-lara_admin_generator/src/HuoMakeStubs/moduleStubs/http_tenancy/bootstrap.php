<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Form;
use Encore\Admin\Grid;

Encore\Admin\Form::forget(['map', 'editor']);

app('view')->prependNamespace('tenancy', resource_path('views/tenancy'));
//app('view')->prependNamespace('admine', resource_path('views/admine'));

\Huojunhao\LaraAdmin\BaseExtends\AdminUtil::defaultBootstrap();

//引入Tenancy函数
require __DIR__ . "/helpers.php";