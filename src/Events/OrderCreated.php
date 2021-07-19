<?php

declare(strict_types=1);

namespace Ctrlc\Order\Events;

use Ctrlc\Order\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated
{
    use Dispatchable, SerializesModels;
    
    public function __construct(public Order $order)
    {
    }
}
