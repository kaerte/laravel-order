<?php

declare(strict_types=1);

namespace Ctrlc\Order\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self COMPLETED()
 * @method static self PENDING()
 * @method static self CANCELLED()
 * @method static self ARCHIVED()
 */
final class Status extends Enum
{
}
