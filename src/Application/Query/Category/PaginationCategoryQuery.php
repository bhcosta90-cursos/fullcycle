<?php

declare(strict_types = 1);

namespace Package\Application\Query\Category;

use App\Models\Category;
use Package\Application\Presenters\PaginationPresenter;
use Package\Core\Domain\Query\Category\PaginationCategoryQueryInterface;
use Package\Shared\Domain\Repository\DTO\OrderInput;
use Package\Shared\Domain\Repository\PaginationInterface;

class PaginationCategoryQuery implements PaginationCategoryQueryInterface
{
    public function handle(array $filter, OrderInput $order = null, int $totalItens = 10): PaginationInterface
    {
        return new PaginationPresenter(Category::query()
            ->like('name', $filter['name'] ?? '')
            ->orderBy($order?->field ?: 'name', $order?->direction->value ?: 'asc')
            ->paginate(perPage: $totalItens));
    }
}
