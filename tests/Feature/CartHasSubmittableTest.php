<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests\Feature;

use Ctrlc\Order\Models\Order;
use Ctrlc\Order\Tests\TestCase;
use Ctrlc\Order\Tests\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartHasSubmittableTest extends TestCase
{
    use RefreshDatabase;
    use CreatesProductableAndCart;

    public Model $productable;
    
    public Model $submittable;
    
    public function test_submittable_is_created(): void
    {
        $user = User::factory()->create();
        
        $cart = $this->getCart();
        $order = Order::createFromCart($cart);
        $order->orderable()->associate($user);
        $order->save();
        
        self::assertSame($order->orderable->name, $user->name);
    }

    public function test_submittable_has_orders(): void
    {
        $user = User::factory()->create();

        $cart = $this->getCart();
        $order = Order::createFromCart($cart);
        $order->orderable()->associate($user);
        $order->save();
        
        self::assertNotEmpty($user->orders);
    }
}
