<?php

declare(strict_types = 1);

use Package\Core\Domain\Query\Category\PaginationCategoryQueryInterface;
use Package\Core\UseCase\Category\DTO\{CategoryPaginateOutput};
use Package\Core\UseCase\Category\{ListCategoryUseCase};
use Tests\Unit\src\Shared\Domain\Repository\PaginationInterfaceTrait;

uses(PaginationInterfaceTrait::class);

it('returns a CategoryPaginateOutput when listing categories', function () {
    $repository = Mockery::mock(PaginationCategoryQueryInterface::class);
    $repository->shouldReceive('handle')->once()->andReturn($this->mockPagination());

    $response = (new ListCategoryUseCase(paginationCategoryQuery: $repository))->handle();

    expect($response)->toBeInstanceOf(CategoryPaginateOutput::class);
});
