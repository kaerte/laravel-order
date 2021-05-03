<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests;

use Ctrlc\Address\Traits\HasOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasOrders;
    use HasFactory;
    use Notifiable;

    protected $guarded = [];

    protected $table = 'users';

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
