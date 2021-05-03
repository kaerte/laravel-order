<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests;

use CreateUsersTable;
use Ctrlc\Order\Providers\OrderServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__.'../database/migrations');
        $this->loadMigrationsFrom(__DIR__.'../migrations');
    }

    protected function getPackageProviders($app): array
    {
        return [OrderServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app): void
    {
        include_once __DIR__.'/migrations/2014_10_12_000000_create_users_table.php';
        (new CreateUsersTable())->up();
    }
}
