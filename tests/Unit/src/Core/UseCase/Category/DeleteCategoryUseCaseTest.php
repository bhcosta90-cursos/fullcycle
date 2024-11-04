<?php

declare(strict_types = 1);

use Package\Core\Domain\Repository\CategoryRepositoryInterface;
use Package\Core\UseCase\Category\{DeleteCategoryUseCase, Exception\CategoryDeleteException};
use Tests\Unit\src\Core\Domain\Entity\Mock\CategoryEntityTrait;

uses(CategoryEntityTrait::class);

it('deletes a category and returns true', function () {
    $repository = Mockery::mock(CategoryRepositoryInterface::class);
    $repository->shouldReceive('delete')->once()->andReturn(true);

    $response = (new DeleteCategoryUseCase(categoryRepository: $repository))->handle('testing');

    expect($response)->toBeTrue();
});

it('throws CategoryDeleteException when category deletion fails', function () {
    $repository = Mockery::mock(CategoryRepositoryInterface::class);
    $repository->shouldReceive('delete')->once()->andReturn(false);

    // Act & Assert
    expect(fn () => (new DeleteCategoryUseCase(categoryRepository: $repository))->handle('testing'))
        ->toThrow(CategoryDeleteException::class);
});
