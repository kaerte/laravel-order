<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests;

use Ctrlc\Basket\Providers\BasketServiceProvider;
use Ctrlc\Order\Providers\OrderServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__.'../database/migrations');
        $this->loadLaravelMigrations();
    }

    protected function getPackageProviders($app): array
    {
        return [
            OrderServiceProvider::class,
            BasketServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'../migrations');
    }
}
