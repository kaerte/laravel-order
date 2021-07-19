<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests;

use Ctrlc\Cart\Providers\CartServiceProvider;
use Ctrlc\DiscountCode\Providers\DiscountCodeServiceProvider;
use Ctrlc\Order\Providers\OrderServiceProvider;
use Plank\Metable\MetableServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadLaravelMigrations();
    }

    protected function getPackageProviders($app): array
    {
        return [
            OrderServiceProvider::class,
            CartServiceProvider::class,
            MetableServiceProvider::class,
            DiscountCodeServiceProvider::class,
        ];
    }
}
