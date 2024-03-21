<?php

use App\Jobs\CleanAddressTable;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})
    ->purpose('Display an inspiring quote')
    ->hourly();

/**
 * Clean address table.
 * Execution time 12:00 PM.
 */
Schedule::job(new CleanAddressTable)
    ->name('Clean address table')
    ->daily()
    ->onOneServer()
    ->withoutOverlapping();
