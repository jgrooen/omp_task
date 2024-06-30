<?php

namespace App\Console\Commands;

use App\Libs\OmpFirstTask;
use Illuminate\Console\Command;

class omp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:omp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo (new OmpFirstTask())->humanReadableNumber('123456.123456789');
    }
}
