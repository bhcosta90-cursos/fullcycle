<?php

declare(strict_types = 1);

use Package\Core\Domain\Query\Category\PaginationCategoryQuery;
use Package\Core\UseCase\Category\DTO\{CategoryPaginateOutput};
use Package\Core\UseCase\Category\{ListCategoryUseCase};
use Tests\Unit\src\Shared\Domain\Repository\PaginationInterfaceTrait;

uses(PaginationInterfaceTrait::class);

it('returns a CategoryPaginateOutput when listing categories', function () {
    // Arrange
    $repository = Mockery::mock(PaginationCategoryQuery::class);
    $repository->shouldReceive('handle')->once()->andReturn($this->mockPagination());

    // Act
    $response = (new ListCategoryUseCase(paginationCategoryQuery: $repository))->handle();

    // Assert
    expect($response)->toBeInstanceOf(CategoryPaginateOutput::class);
});
