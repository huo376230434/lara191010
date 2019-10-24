<?php

namespace Huojunhao\LibDev\Console;

use Illuminate\Console\Command;

class HuoSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do:seed {params?} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成测试';

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
        if($params = $this->argument('params')){
            huoseed($params);
        }else{
            huoseedAll(true);
        }

    }
}
