<?php

namespace App\Console;

use App\Jobs\TestMainJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        info("schedule ".get_current_user());
        $tag = date("H:i")." ";
        $arr = range(1,100000);
        for ($i = 0; $i < 1000; $i++) {
            $arr = array_reverse($arr);
        }
        $schedule->call(function(){
            $arr = range(1, 30);
            foreach ($arr as $item) {
                $tag =  "多次分发job ".$item."  ".date("H:i")."  ";

                dispatch(new TestMainJob($tag));

            }

        })->everyFifteenMinutes();

        dispatch(new TestMainJob($tag));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
