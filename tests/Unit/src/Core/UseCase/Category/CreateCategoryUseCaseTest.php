<?php

declare(strict_types = 1);

use Package\Core\Domain\Repository\CategoryRepository;
use Package\Core\UseCase\Category\CreateCategoryUseCase;
use Package\Core\UseCase\Category\DTO\{CategoryOutput, CreateCategoryInput};
use Tests\Unit\src\Core\Domain\Entity\Mock\CategoryEntityTrait;

uses(CategoryEntityTrait::class);

it('creates a category and returns a CategoryOutput', function () {
    // Arrange
    $repository = Mockery::mock(CategoryRepository::class);
    $repository->shouldReceive('create')->once()->andReturn($this->makeCategoryEntity());
    $input = Mockery::mock(CreateCategoryInput::class, ['test', 'test']);

    // Act
    $response = (new CreateCategoryUseCase(categoryRepository: $repository))->handle($input);

    // Assert
    expect($response)->toBeInstanceOf(CategoryOutput::class);
});
