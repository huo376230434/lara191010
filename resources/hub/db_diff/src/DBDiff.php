<?php

namespace Encore\Admin\DBDiff;

use Encore\Admin\Extension;
use Illuminate\Http\Request;

class DBDiff extends Extension
{
    public $name = 'db-diff';

    public $views = __DIR__ . '/../resources/views';

    public $menu = [
        'title' => '数据库比对',
        'path'  => 'db-diff',
        'icon'  => 'fa-random',
    ];

    /**
     * @param Request $request
     * @return mixed
     */
    public static function getDiff(Request $request)
    {
        if ($request->isMethod('POST')) {
            $source = app('db.factory')->make($request->source);
            $target = app('db.factory')->make($request->target);

            $differ = new DBDiffer($source, $target);

            return $differ->getDiff();
        }

        return null;
    }

    /**
     * @return array
     */
    public static function options()
    {
        $default = [
            'showFiles'    => true,
            'matching'     => 'none',
            'outputFormat' => 'side-by-side',
        ];

        return array_merge($default, static::config('options', []));
    }
}
