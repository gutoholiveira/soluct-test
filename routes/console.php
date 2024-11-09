<?php

use App\Services\ProductService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    (new ProductService())->executeImportProductsRoutine();
    Cache::put('last_cron_execution', date('Y-m-d H:i:s'));
})->dailyAt(config('app.sync_time'));