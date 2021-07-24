<?php

declare(strict_types=1);

namespace Ctrlc\Order\Traits;

use Ctrlc\Order\Models\Order;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Orderable
{
    public function orders(): MorphMany
    {
        return $this->morphMany(Order::class, 'orderable');
    }
}
