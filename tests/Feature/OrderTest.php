<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests\Feature;

use Ctrlc\Order\Tests\TestCase;
use Ctrlc\Order\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public User $addressable;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_something(): void
    {
    }
}
