<?php

declare(strict_types = 1);

namespace Package\Core\Domain\Query\Category;

use Package\Shared\Domain\Repository\DTO\OrderInput;
use Package\Shared\Domain\Repository\PaginationInterface;

interface PaginationCategoryQueryInterface
{
    public function handle(
        array      $filter,
        OrderInput $order = null,
        int        $totalItens = 10,
    ): PaginationInterface;
}
