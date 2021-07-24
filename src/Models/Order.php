<?php

declare(strict_types=1);

namespace Ctrlc\Order\Models;

use Ctrlc\Cart\Cart;
use Ctrlc\Cart\Traits\Cartable;
use Ctrlc\Order\Database\Factories\OrderFactory;
use Ctrlc\Order\Enums\Status;
use Ctrlc\Order\Events\OrderArchived;
use Ctrlc\Order\Events\OrderCancelled;
use Ctrlc\Order\Events\OrderCompleted;
use Ctrlc\Order\Events\OrderCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Order extends Model
{
    use HasFactory;
    use Cartable;

    protected $casts = [
        'cart_snapshot' => 'array',
    ];

    public static function createFromCart(Cart $cart): Order
    {
        if ($cart->isEmpty()) {
            throw new \InvalidArgumentException('Order cannot be created from an empty cart');
        }
        
        $order = new self();
        $order->cart_snapshot = $cart->load('items.item')->toArray();
        $order->total = $cart->total;
        $order->save();

        event(new OrderCreated($order));
      
        return $order;
    }

    public function orderable(): MorphTo
    {
        return $this->morphTo();
    }
    
    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }

    public function complete(): self
    {
        $this->status = Status::COMPLETED();
        $this->save();

        event(new OrderCompleted($this));
        
        return $this;
    }

    public function cancel(): self
    {
        $this->status = Status::CANCELLED();
        $this->save();

        event(new OrderCancelled($this));

        return $this;
    }

    public function archive(): self
    {
        $this->status = Status::ARCHIVED();
        $this->save();

        event(new OrderArchived($this));

        return $this;
    }
}
