<?php

namespace App\Console;

use App\Schedule\PaymentChargeSchedule;
use App\Schedule\ResourceAvailabilitySchedule;
use App\Schedule\ScholarshipAllocatorSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(ResourceAvailabilitySchedule::class)->everyMinute();
        $schedule->call(ScholarshipAllocatorSchedule::class)->monthly();
        $schedule->call(PaymentChargeSchedule::class)->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}