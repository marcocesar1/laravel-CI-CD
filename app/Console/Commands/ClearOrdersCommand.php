<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearOrdersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-orders-command';

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
        $this->info('Clearing orders...');

        \App\Models\OrderItem::query()->delete();
        \App\Models\Order::query()->delete();

        $this->info('Orders cleared!');
    }
}
