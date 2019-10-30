<?php

namespace Encore\Admin\DBDiff\Http\Controllers;

use Encore\Admin\Layout\Content;
use Encore\Admin\DBDiff\DBDiff;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DBDiffController extends Controller
{
    public function index(Content $content, Request $request)
    {
        $diff = null;
        $error = '';

        try {
            $diff = DBDiff::getDiff($request);
        } catch (\Exception $exception) {
            $error = $exception->getMessage();
        }

        $options = DBDiff::options();

        $view = view(
            'laravel-admin-db-diff::index',
            compact('diff', 'error', 'options')
        );

        return $content
            ->header('数据库结构比对')
            ->description(' ')
            ->body($view);
    }
}
