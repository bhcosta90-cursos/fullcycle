<?php

declare(strict_types = 1);

use Package\Core\Domain\Repository\CategoryRepositoryInterface;
use Package\Core\UseCase\Category\DTO\{CategoryOutput};
use Package\Core\UseCase\Category\{ShowCategoryUseCase};
use Tests\Unit\src\Core\Domain\Entity\Mock\CategoryEntityTrait;

uses(CategoryEntityTrait::class);

it('show a category and returns a CategoryOutput', function () {
    $repository = Mockery::mock(CategoryRepositoryInterface::class);
    $repository->shouldReceive('find')->once()->andReturn($this->makeCategoryEntity());

    $response = (new ShowCategoryUseCase(categoryRepository: $repository))->handle('testing');

    expect($response)->toBeInstanceOf(CategoryOutput::class);
});
