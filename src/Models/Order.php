<?php

declare(strict_types=1);

namespace Ctrlc\Order\Models;

use Ctrlc\Basket\Models\Basket;
use Ctrlc\Order\Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'basket_snapshot' => 'array',
    ];

    public static function createFromBasket(Basket $basket): Order
    {
        $order = new self();
        $order->basket = $basket;
        $order->save();

        return $order;
    }

    public function basket(): BelongsTo
    {
        return $this->belongsTo(Basket::class);
    }

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }
}
