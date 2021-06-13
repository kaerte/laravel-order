<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests;

use Ctrlc\Basket\Traits\HasBasket;
use Ctrlc\Basket\Traits\Productable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasBasket;
    use Productable;

    protected $guarded = [];

    protected $table = 'users';

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
