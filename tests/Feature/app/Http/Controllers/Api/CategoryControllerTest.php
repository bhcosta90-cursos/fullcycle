<?php

declare(strict_types = 1);

use App\Http\Controllers\Api\CategoryController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Package\Application\Query\Category\PaginationCategoryQuery;
use Package\Core\UseCase\Category\ListCategoryUseCase;

beforeEach(function () {
    $this->category           = new Category();
    $this->paginateRepository = new PaginationCategoryQuery($this->category);
});

it('', function () {
    // Arrange
    $useCase    = new ListCategoryUseCase($this->paginateRepository);
    $controller = new CategoryController();

    // Act
    $response = $controller->index(new Request(), $useCase);

    // Assert
    expect($response)->toBeInstanceOf(AnonymousResourceCollection::class)
        ->and($response->additional)->toHaveKey('meta')
        ->and($response->additional['meta'])->toHaveKeys([
            'total',
            'per_page',
            'current_page',
            'last_page',
            'from',
            'to',
            'first_page',
        ]);
});
