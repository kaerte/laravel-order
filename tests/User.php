<?php

declare(strict_types=1);

namespace Ctrlc\Order\Tests;

use Ctrlc\Cart\Traits\Cartable;
use Ctrlc\Cart\Traits\Productable;
use Ctrlc\Order\Traits\Orderable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use Cartable;
    use Productable;
    use Orderable;

    protected $guarded = [];

    protected $table = 'users';

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
