<?php

declare(strict_types = 1);

namespace Package\Core\Domain\Query\Category;

use Package\Shared\Domain\Repository\PaginationInterface;

interface PaginationCategoryQuery
{
    public function handle(): PaginationInterface;
}
