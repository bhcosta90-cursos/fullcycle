<?php

declare(strict_types = 1);

use Package\Core\Domain\Repository\CategoryRepository;
use Package\Core\UseCase\Category\DTO\{CategoryOutput};
use Package\Core\UseCase\Category\{ShowCategoryUseCase};
use Package\Shared\Domain\Exception\EntityNotFound;
use Tests\Unit\src\Core\Domain\Entity\Mock\CategoryEntityTrait;

uses(CategoryEntityTrait::class);

it('show a category and returns a CategoryOutput', function () {
    // Arrange
    $repository = Mockery::mock(CategoryRepository::class);
    $repository->shouldReceive('find')->once()->andReturn($this->makeCategoryEntity());

    // Act
    $response = (new ShowCategoryUseCase(categoryRepository: $repository))->handle('testing');

    // Assert
    expect($response)->toBeInstanceOf(CategoryOutput::class);
});

it('throws EntityNotFound when category is not found', function () {
    // Arrange
    $repository = Mockery::mock(CategoryRepository::class);
    $repository->shouldReceive('find')->once()->andReturn(null);

    // Act
    expect(fn () => (new ShowCategoryUseCase(categoryRepository: $repository))->handle('testing'))
        ->toThrow(EntityNotFound::class);
});