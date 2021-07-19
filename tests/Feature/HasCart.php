<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests\Feature;

use Ctrlc\Cart\Facades\Cart;
use Ctrlc\Order\Tests\User;

trait HasCart
{
    public function getCart()
    {
        $productable = User::factory()
                ->hasVariants(1, [
                    'default' => 1,
                    'quantity' => 10,
                ])
                ->create();
            
        $productVariant = $productable->defaultVariant;

        return Cart::add($productVariant)->add($productVariant);
    }
}
