<?php

namespace zitaraventas\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Backup;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \zitaraventas\Console\Commands\Inspire::class,
        \zitaraventas\Console\Commands\databaseBackup::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         //$schedule->command('Inspire')->everyFiveMinutes();
         $schedule->command('backup:database')->everyFiveMinutes();
    }
}
