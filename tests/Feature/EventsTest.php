<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests\Feature;

use Ctrlc\Order\Events\OrderArchived;
use Ctrlc\Order\Events\OrderCancelled;
use Ctrlc\Order\Events\OrderCompleted;
use Ctrlc\Order\Events\OrderCreated;
use Ctrlc\Order\Models\Order;
use Ctrlc\Order\Tests\TestCase;
use Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventsTest extends TestCase
{
    use RefreshDatabase;
    use CreatesProductableAndCart;

    public function test_created_event_dispatched(): void
    {
        Event::fake();

        $order = Order::createFromCart($this->getCart());
        
        Event::assertDispatched(OrderCreated::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });
    }

    public function test_completed_event_dispatched(): void
    {
        Event::fake();

        $order = Order::createFromCart($this->getCart());
        $order->complete();

        Event::assertDispatched(OrderCompleted::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });
        
        self::assertNotNull($order->completed_at);
    }
    
    public function test_canceled_event_dispatched(): void
    {
        Event::fake();
        
        $order = Order::createFromCart($this->getCart());
        $order->cancel();
        
        Event::assertDispatched(OrderCancelled::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });

        self::assertNotNull($order->canceled_at);
    }

    public function test_archived_event_dispatched(): void
    {
        Event::fake();

        $order = Order::createFromCart($this->getCart());
        $order->archive();

        Event::assertDispatched(OrderArchived::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });

        self::assertNotNull($order->archived_at);
    }
}
