<?php

declare(strict_types = 1);

use Package\Core\Domain\Repository\CategoryRepository;
use Package\Core\UseCase\Category\CreateCategoryUseCase;
use Package\Core\UseCase\Category\DTO\CategoryOutput;
use Tests\Unit\src\Core\Domain\Entity\Mock\CategoryEntityTrait;

uses(CategoryEntityTrait::class);

it('creates a category and returns a CategoryOutput', function () {
    // Arrange
    $repository = Mockery::mock(CategoryRepository::class);
    $repository->shouldReceive('create')->once()->andReturn($this->makeCategoryEntity());
    $useCase = new CreateCategoryUseCase(categoryRepository: $repository);

    // Act
    $response = $useCase->handle('category name');

    // Assert
    expect($response)->toBeInstanceOf(CategoryOutput::class);
});
