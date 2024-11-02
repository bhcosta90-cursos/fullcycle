<?php

declare(strict_types = 1);

use Package\Core\Domain\Repository\CategoryRepository;
use Package\Core\UseCase\Category\DTO\{CategoryOutput, CategoryUpdateInput};
use Package\Core\UseCase\Category\{UpdateCategoryUseCase};
use Package\Shared\Domain\Exception\EntityNotFoundException;
use Tests\Unit\src\Core\Domain\Entity\Mock\CategoryEntityTrait;

uses(CategoryEntityTrait::class);

it('update a category and returns a CategoryOutput', function () {
    // Arrange
    $repository = Mockery::mock(CategoryRepository::class);
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
    $repository = Mockery::mock(CategoryRepository::class);
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
    $repository = Mockery::mock(CategoryRepository::class);
    $repository->shouldReceive('find')->once()->andReturn($entity = $this->makeCategoryEntity(isActive: false));
    $repository->shouldReceive('update')->once()->andReturn($entity);
    $input = Mockery::mock(CategoryUpdateInput::class, ['1', 'testing', 'testing', true]);

    // Act
    $response = (new UpdateCategoryUseCase(categoryRepository: $repository))->handle($input);

    // Assert
    expect($response)->toBeInstanceOf(CategoryOutput::class);
});

it('throws EntityNotFoundException when category is not found', function () {
    // Arrange
    $repository = Mockery::mock(CategoryRepository::class);
    $repository->shouldReceive('find')->once()->andReturn(null);

    // Act
    expect(fn () => (new UpdateCategoryUseCase(categoryRepository: $repository))->handle(new CategoryUpdateInput(
        id: 'testing',
        name: 'testing',
        description: 'testing',
        is_active: true,
    )))
        ->toThrow(EntityNotFoundException::class);
});