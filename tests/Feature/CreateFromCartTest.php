<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests\Feature;

use Ctrlc\Cart\Facades\Cart;
use Ctrlc\Order\Models\Order;
use Ctrlc\Order\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;

class CreateFromCartTest extends TestCase
{
    use RefreshDatabase;
    use CreatesProductableAndCart;
    
    public function test_create_order_from_cart(): void
    {
        $cart = $this->getCart();
        $order = Order::createFromCart($cart);
        self::assertSame($order->cart_snapshot, $cart->toArray());
    }

    public function test_cannot_create_from_empty_cart(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Order::createFromCart(Cart::get());
    }
}
