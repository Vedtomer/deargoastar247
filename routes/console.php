<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('generate:draw', function () {
    $this->call('App\Console\Commands\GenerateDraw');
})->purpose('Generate a draw every hour')->daily();


