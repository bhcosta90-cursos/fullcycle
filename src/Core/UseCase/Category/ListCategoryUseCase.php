<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category;

use Package\Core\Domain\Query\Category\PaginationCategoryQuery;
use Package\Core\UseCase\Category\DTO\{CategoryPaginateOutput};
use Package\Shared\Domain\Repository\DTO\OrderInput;
use Package\Shared\Domain\Repository\Enum\Order;

class ListCategoryUseCase
{
    public function __construct(
        protected PaginationCategoryQuery $paginationCategoryQuery,
    ) {
    }

    public function handle(array $filter = [], string $order = 'asc'): CategoryPaginateOutput
    {
        $categories = $this->paginationCategoryQuery->handle(
            filter: $filter,
            order: new OrderInput('name', Order::from($order))
        );

        return new CategoryPaginateOutput(
            items: $categories->items(),
            total: $categories->total(),
            current_page: $categories->currentPage(),
            last_page: $categories->lastPage(),
            first_page: $categories->firstPage(),
            per_page: $categories->perPage(),
            to: $categories->to(),
            from: $categories->from(),
        );
    }
}
