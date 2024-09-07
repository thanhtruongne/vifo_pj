<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Xóa cache mỗi 23h hằng ngày';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
