<?php

declare(strict_types = 1);

use Package\Application\Repository\CategoryRepository;
use Package\Core\Domain\Entity\CategoryEntity;

use function Pest\Laravel\assertDatabaseCount;

beforeEach(fn () => $this->categoryRepository = app(CategoryRepository::class));

it('creates a category and verifies it in the database', function () {
    // Arrange
    $data = new CategoryEntity(name: 'testing', description: 'testing', isActive: false);

    // Act
    $result = $this->categoryRepository->create($data);

    // Assert
    expect($result)->toBeInstanceOf(CategoryEntity::class);
    assertDatabaseCount('categories', 1);
});
