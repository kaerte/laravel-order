<?php

declare(strict_types=1);

namespace Ctrlc\Order\Models;

use Ctrlc\Cart\Models\Cart;
use Ctrlc\Cart\Traits\HasCart;
use Ctrlc\Order\Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use HasCart;

    protected $casts = [
        'items_snapshot' => 'array',
    ];

    public static function createFromCart(Cart $cart): Order
    {
        $order = new self();
        $order->cart = $cart;
        $order->save();

        return $order;
    }

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }
}
