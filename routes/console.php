<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// =============================
// ORDERS CLEANUP (SEPARATE)
// =============================
Schedule::command('app:delete-old-delivered-orders')
    ->dailyAt('01:00')
    ->withoutOverlapping();


// =============================
// EMPLOYEE CLEANUP (SEPARATE)
// =============================
Schedule::command('app:delete-old-employee-records')
    ->dailyAt('02:00')
    ->withoutOverlapping();
