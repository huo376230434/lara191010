<?php

namespace App\Console\Commands\Daily;

use Huojunhao\Lib\Base\FileUtil;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PrimaryTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dl:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '主要测试';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $r =is_dir(null);
        dd($r);

        $str = "";
        $files = FileUtil::allFile(database_path('migrations'));
//        dd($files);
       $r = collect($files)->some(function($value)use ($str){
           dump($value);
           dump($str);
           return Str::contains($value, $str);
       });
        dd($r);
        dd(Str::snake('LaraAdminGenerator'));
        dd(config('admin.name'));
        throw new \Exception("haha");

    }



}
