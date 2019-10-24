<?php

namespace Huojunhao\LibDev\Console;

use Huojunhao\Lib\Base\FileUtil;
use Illuminate\Console\Command;

class HuoQuickPushHub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do:hubpush  ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '快速推hub下的代码到仓库中';

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
        $hubs = FileUtil::allFile(storage_path('hub'));

        foreach ($hubs as $hub) {
            $this->info($hub);
            $command = " cd ".storage_path('hub/'.$hub) ." && git add . && git commit -m 'auto push ' && git push";
            echo shell_exec($command);
        }

    }
}
