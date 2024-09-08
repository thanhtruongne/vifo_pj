<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCache extends Command
{
    protected $signature = 'app:clear-cache';
    protected $description = 'Xóa cache chạy 1 ngày 1 lần (0 1 * * *)';
    protected $expression ='0 1 * * *';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Artisan::call('cache:clear');
    }
}
