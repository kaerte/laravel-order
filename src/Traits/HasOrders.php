<?php

declare(strict_types=1);

namespace Ctrlc\Order\Traits;

use Ctrlc\Order\Models\Order;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasOrders
{
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
