<?php

declare(strict_types=1);

namespace Ctrlc\Order\Observers;

use Ctrlc\Order\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    public function created(Order $order)
    {
        Log::info('order created', [$order]);
        $order->basket_snapshot = $order->basket->toArray();
        $order->saveQuietly();
    }

    public function updated(Order $order)
    {
        Log::info('order updated', [$order]);
        $order->basket_snapshot = $order->basket->toArray();
        $order->saveQuietly();
    }

    public function deleted(Order $order)
    {
        Log::info('order deleted', [$order]);
    }

    public function forceDeleted(Order $order)
    {
        Log::info('order force deleted', [$order]);
    }
}
