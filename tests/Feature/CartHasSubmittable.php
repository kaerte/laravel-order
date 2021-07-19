<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests\Feature;

use Ctrlc\Cart\Tests\User;
use Ctrlc\Order\Models\Order;
use Ctrlc\Order\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartHasSubmittable extends TestCase
{
    use RefreshDatabase;
    use HasCart;

    public Model $productable;
    
    public Model $submittable;
    
    public function test_create_order_from_cart(): void
    {
        $user = User::factory()->create();
        
        $cart = $this->getCart();
        $order = Order::createFromCart($cart);
        $order->submittable()->associate($user);
        
        self::assertSame($order->submittable, $user);
    }
}
