<?php

use App\Jobs\CreateRandomOrdersJob;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:create-random-orders-command')->everySecond();

Schedule::job(new CreateRandomOrdersJob)->everyTwoMinutes();
