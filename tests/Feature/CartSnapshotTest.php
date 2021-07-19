<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests\Feature;

use Ctrlc\Order\Models\Order;
use Ctrlc\Order\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartSnapshotTest extends TestCase
{
    use RefreshDatabase;
    use HasCart;

    public function test_create_order_from_cart(): void
    {
        $cart = $this->getCart();
        $order = Order::createFromCart($cart);
        
        self::assertArrayHasKey('id', $order->cart_snapshot);
        self::assertArrayHasKey('items', $order->cart_snapshot);
        self::assertArrayHasKey('total', $order->cart_snapshot);
        self::assertArrayHasKey('discount_code', $order->cart_snapshot);
        self::assertArrayHasKey('cartable_type', $order->cart_snapshot);
        self::assertArrayHasKey('cartable_id', $order->cart_snapshot);
    }
}
