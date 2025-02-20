<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class CreateRandomOrdersJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Creating random orders');
        
        $user = User::factory()->create();
        $randomOrders = Order::factory()->count(10)->make();

        foreach ($randomOrders as $order) {
            $randomOrderItems = OrderItem::factory()->count(5)->make();

            $total = $randomOrderItems->sum('total');
            $order->total = $total;

            $user->orders()->save($order);
            $order->items()->saveMany($randomOrderItems);
        }
    }
}
