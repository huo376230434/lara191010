<?php

use Encore\Admin\DBDiff\Http\Controllers\DBDiffController;

Route::match(['get', 'post'], 'db-diff', DBDiffController::class.'@index')->name('db-diff');