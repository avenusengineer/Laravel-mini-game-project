<?php

namespace App\Console;

use App\Console\Commands\BuildGameFlavors;
use App\Console\Commands\BuildGameFlavorsForVersion;
use App\Console\Commands\CleanOldGames;
use App\Console\Commands\DeleteGameVersion;
use App\Console\Commands\UpdateShapesUsersTokens;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CleanOldGames::class,
        DeleteGameVersion::class,
        BuildGameFlavors::class,
        BuildGameFlavorsForVersion::class,
        UpdateShapesUsersTokens::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        $schedule->command('shapes:update-user-tokens')->everyThreeHours()->withoutOverlapping();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands() {
        require base_path('routes/console.php');
    }
}
