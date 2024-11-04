<?php

declare(strict_types = 1);

use Package\Core\Domain\Repository\CategoryRepositoryInterface;
use Package\Core\UseCase\Category\CreateCategoryUseCase;
use Package\Core\UseCase\Category\DTO\{CategoryCreateInput, CategoryOutput};
use Tests\Unit\src\Core\Domain\Entity\Mock\CategoryEntityTrait;

uses(CategoryEntityTrait::class);

it('creates a category and returns a CategoryOutput', function () {
    $repository = Mockery::mock(CategoryRepositoryInterface::class);
    $repository->shouldReceive('create')->once()->andReturn($this->makeCategoryEntity());
    $input = Mockery::mock(CategoryCreateInput::class, ['test', 'test', true]);

    $response = (new CreateCategoryUseCase(categoryRepository: $repository))->handle($input);

    expect($response)->toBeInstanceOf(CategoryOutput::class);
});
