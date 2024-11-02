<?php

declare(strict_types = 1);

use App\Models\Category;
use Package\Application\Repository\CategoryRepository;
use Package\Core\UseCase\Category\CreateCategoryUseCase;
use Package\Core\UseCase\Category\DTO\CategoryCreateInput;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas};

it('creates a category and verifies it in the database', function () {
    // Arrange
    $repository = new CategoryRepository(new Category());
    $useCase    = new CreateCategoryUseCase(categoryRepository: $repository);

    // Act
    $response = $useCase->handle(new CategoryCreateInput(name: 'Category Test', description: 'Description Test'));

    // Assert
    assertDatabaseCount('categories', 1);
    assertDatabaseHas('categories', [
        'id'          => $response->id,
        'name'        => 'Category Test',
        'description' => 'Description Test',
        'is_active'   => true,
    ]);
});
