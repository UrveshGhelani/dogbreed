<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\UpdateBreeds;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        UpdateBreeds::class,
    ];

    // To update the breed:update handler every 30 min

    protected function schedule(Schedule $schedule)
    {
        // Call Command every 30 min to update breed table 
        $schedule->command('breeds:update')->everyThirtyMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
