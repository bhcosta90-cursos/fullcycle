<?php

declare(strict_types = 1);

namespace Package\Shared\Domain\Repository\DTO;

use Package\Shared\Domain\Repository\Enum\Order;

class OrderInput
{
    public function __construct(
        public string $field,
        public Order $direction,
    ) {
    }
}
