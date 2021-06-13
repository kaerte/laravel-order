<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests\Feature;

use Ctrlc\Basket\Facades\Basket;
use Ctrlc\Basket\Models\Basket as BasketModel;
use Ctrlc\Order\Models\Order;
use Ctrlc\Order\Tests\TestCase;
use Ctrlc\Order\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public User $productable;

    public BasketModel $basket;

    protected function setUp(): void
    {
        parent::setUp();
        //User with Productable trait
        $this->productable = User::factory()
            ->hasVariants(1, [
                'default' => 1,
            ])
            ->create();

        $productVariant = $this->productable->defaultVariant;
        $this->basket = Basket::add($productVariant)->add($productVariant);
    }

    public function test_order_has_basket(): void
    {
        $order = new Order();
        $order->total = $this->basket->total;
        $order->basket()->associate($this->basket);

        $order->save();

        self::assertInstanceOf(BasketModel::class, $order->basket);
        self::assertIsArray($order->basket_snapshot);
        self::assertNotEmpty($order->basket_snapshot);
        self::assertEquals($order->total, $order->basket->total);
    }
}
