<?php

declare(strict_types = 1);

use App\Models\Category;
use Package\Application\Repository\CategoryRepository;
use Package\Core\UseCase\Category\{DeleteCategoryUseCase};

use function Pest\Laravel\{assertDatabaseCount, assertSoftDeleted};

it('deletes a category and verifies it is soft deleted in the database', function () {
    // Arrange
    $category   = Category::factory()->create();
    $repository = new CategoryRepository(new Category());
    $useCase    = new DeleteCategoryUseCase(categoryRepository: $repository);

    // Act
    $response = $useCase->handle($category->id);

    // Assert
    assertDatabaseCount('categories', 1);
    assertSoftDeleted($category);
});
