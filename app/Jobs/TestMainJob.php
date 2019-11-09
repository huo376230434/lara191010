<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestMainJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tag;
    protected $counts = 500;

    protected $exception = false;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tag)
    {
        //
        $this->tag = $tag;
        if(rand(1,10)=== 6){
            $this->counts = $this->counts *100;
            $this->tag = "超时——" . $this->tag;
        }

        if (rand(1, 10) === 7) {
            $this->exception = true;
            $this->tag = "异常——" . $this->tag;

        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $prefix = "开始JOB ".date("H:i:s");
        $arr = range(1,100000);

        if ($this->exception ) throw new \Exception($this->tag."HAHA 异常了");

        for ($i = 0; $i < $this->counts; $i++) {
            $arr = array_reverse($arr);
        }
        info(" tag:".$this->tag.$prefix." TestJob 结束: ".date("H:i:s")." 进程：".getmypid());
        //
    }

    public function tags()
    {
        return [ $this->tag];
    }
}
