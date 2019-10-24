<?php

namespace Huojunhao\LaraAdmin\BaseExtends\Plugins\Log;

use Huojunhao\LaraAdmin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LogController extends Controller
{
    protected $title = "日志管理";
    /**
     * @param null $file
     * @param Request $request
     * @return Content
     * @throws \Exception
     */
    public function index( Request $request,$file = null)
    {
        if ($file === null) {
            $file = (new LogViewer())->getLastModifiedLog();
        }
        $content = new Content();


        $offset = $request->get('offset');

        $viewer = new LogViewer($file);

        $content->body(view('admine::base.plugins.logs', [
            'logs'      => $viewer->fetch($offset),
            'logFiles'  => $viewer->getLogFiles(),
            'fileName'  => $viewer->file,
            'end'       => $viewer->getFilesize(),
            'tailPath'  => route('log-viewer-tail', ['file' => $viewer->file]),
            'prevUrl'   => $viewer->getPrevPageUrl(),
            'nextUrl'   => $viewer->getNextPageUrl(),
            'filePath'  => $viewer->getFilePath(),
            'size'      => static::bytesToHuman($viewer->getFilesize()),
        ]));

        $content->header($this->title);
        $content->description($viewer->getFilePath());
        return $content;
    }

    public function tail($file, Request $request)
    {
        $offset = $request->get('offset');

        $viewer = new LogViewer($file);

        list($pos, $logs) = $viewer->tail($offset);

        return compact('pos', 'logs');
    }

    protected static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2).' '.$units[$i];
    }
}
