<?php

namespace App\Console;

use App\Http\Controllers\TorrentController;
use App\ShowMeta;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
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
    protected function schedule(Schedule $schedule) {
        $schedule->call(function () {
            $shows = ShowMeta::where('schedule', date('Y-m-d', strtotime('-1 day')))
                ->where('magnet', '')->get();
            foreach ($shows as $key => $show) {
                $name = sprintf("%s S%02dE%02d", $show->show->name, $show->season, $show->episode);
                $t = new TorrentController();
                $t->findTorrent($name, $show->id);
            }
        })->everyThirtyMinutes();
    }
}
