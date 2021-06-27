<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests\Feature;

use Ctrlc\Cart\Facades\Cart;
use Ctrlc\Cart\Models\Cart as CartModel;
use Ctrlc\Order\Models\Order;
use Ctrlc\Order\Tests\TestCase;
use Ctrlc\Order\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public User $productable;

    public CartModel $cart;

    protected function setUp(): void
    {
        parent::setUp();
        //User with Productable trait
        $this->productable = User::factory()
            ->hasVariants(1, [
                'default' => 1,
                'quantity' => 10,
            ])
            ->create();
    }

    public function test_order_has_basket(): void
    {
        $productVariant = $this->productable->defaultVariant;
        $cart = Cart::add($productVariant)->add($productVariant);

        //todo create from service?
        $order = new Order();
        $order->saveQuietly();

        $order->cart()->save($cart);
        $order->total = $cart->total;
        $order->save();

        self::assertInstanceOf(CartModel::class, $order->cart);
        self::assertIsArray($order->items_snapshot);
        self::assertNotEmpty($order->items_snapshot);
        self::assertEquals($order->total, $order->cart->total);
    }
}
