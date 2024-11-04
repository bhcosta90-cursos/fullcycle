<?php

declare(strict_types = 1);

use App\Models\Category;
use Package\Application\Query\Category\PaginationCategoryQuery;
use Package\Core\UseCase\Category\ListCategoryUseCase;

it('lists categories and verifies the total count in the database', function () {
    Category::factory(5)->create();
    $repository = new PaginationCategoryQuery(new Category());
    $useCase    = new ListCategoryUseCase(paginationCategoryQuery: $repository);

    $response = $useCase->handle();

    expect($response)->total->toBe(5);
});
