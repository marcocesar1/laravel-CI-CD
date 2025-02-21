<?php

namespace App\Console\Commands;

use App\Jobs\CreateRandomOrdersJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateRandomOrdersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

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
        Log::info('Command executed successfully');
    }
}
