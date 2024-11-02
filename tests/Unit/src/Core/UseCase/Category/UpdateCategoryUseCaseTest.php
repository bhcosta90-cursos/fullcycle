<?php

declare(strict_types = 1);

use Package\Core\Domain\Repository\CategoryRepositoryInterface;
use Package\Core\UseCase\Category\DTO\{CategoryOutput, CategoryUpdateInput};
use Package\Core\UseCase\Category\{UpdateCategoryUseCase};
use Tests\Unit\src\Core\Domain\Entity\Mock\CategoryEntityTrait;

uses(CategoryEntityTrait::class);

it('update a category and returns a CategoryOutput', function () {
    // Arrange
    $repository = Mockery::mock(CategoryRepositoryInterface::class);
    $repository->shouldReceive('find')->once()->andReturn($entity = $this->makeCategoryEntity());
    $repository->shouldReceive('update')->once()->andReturn($entity);
    $input = Mockery::mock(CategoryUpdateInput::class, ['1', 'testing', 'testing', true]);

    // Act
    $response = (new UpdateCategoryUseCase(categoryRepository: $repository))->handle($input);

    // Assert
    expect($response)->toBeInstanceOf(CategoryOutput::class);
});

it('disabled a category and returns a CategoryOutput', function () {
    // Arrange
    $repository = Mockery::mock(CategoryRepositoryInterface::class);
    $repository->shouldReceive('find')->once()->andReturn($entity = $this->makeCategoryEntity());
    $repository->shouldReceive('update')->once()->andReturn($entity);
    $input = Mockery::mock(CategoryUpdateInput::class, ['1', 'testing', 'testing', false]);

    // Act
    $response = (new UpdateCategoryUseCase(categoryRepository: $repository))->handle($input);

    // Assert
    expect($response)->toBeInstanceOf(CategoryOutput::class);
});

it('enable a category and returns a CategoryOutput', function () {
    // Arrange
    $repository = Mockery::mock(CategoryRepositoryInterface::class);
    $repository->shouldReceive('find')->once()->andReturn($entity = $this->makeCategoryEntity(isActive: false));
    $repository->shouldReceive('update')->once()->andReturn($entity);
    $input = Mockery::mock(CategoryUpdateInput::class, ['1', 'testing', 'testing', true]);

    // Act
    $response = (new UpdateCategoryUseCase(categoryRepository: $repository))->handle($input);

    // Assert
    expect($response)->toBeInstanceOf(CategoryOutput::class);
});
