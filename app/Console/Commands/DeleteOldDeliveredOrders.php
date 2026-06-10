<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldDeliveredOrders extends Command
{
    protected $signature = 'app:delete-old-delivered-orders';

    protected $description = 'Delete delivered orders older than 6 months';

    public function handle()
    {
        $dateLimit = Carbon::now()->subMonths(6);

        Order::where('status', 'Delivered')
            ->whereNotNull('delivery_date')
            ->where('delivery_date', '<=', $dateLimit)
            ->delete();

        $this->info('Old delivered orders deleted successfully.');
    }
}
