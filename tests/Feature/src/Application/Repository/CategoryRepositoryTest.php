<?php

declare(strict_types = 1);

use App\Models\Category;
use Package\Application\Repository\CategoryRepository;
use Package\Core\Domain\Entity\CategoryEntity;

use Package\Core\UseCase\Category\Exception\CategoryNotFoundException;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas, assertSoftDeleted};

beforeEach(fn () => $this->categoryRepository = new CategoryRepository(new Category()));

it('creates a category and verifies it in the database', function () {
    // Arrange
    $data = new CategoryEntity(name: 'testing', description: 'testing', isActive: false);

    // Act
    $result = $this->categoryRepository->create($data);

    // Assert
    expect($result)->toBeInstanceOf(CategoryEntity::class);
    assertDatabaseCount('categories', 1);
});

it('updated a category and verifies it in the database', function () {
    // Arrange
    $category       = Category::factory()->create();
    $categoryEntity = CategoryEntity::make($category->toArray());

    // Act
    $result = $this->categoryRepository->update($categoryEntity);

    // Assert
    expect($result)->toBeInstanceOf(CategoryEntity::class);
    assertDatabaseCount('categories', 1);
    assertDatabaseHas('categories', [
        'id'          => $category->id,
        'name'        => $categoryEntity->name,
        'description' => $categoryEntity->description,
        'is_active'   => $categoryEntity->isActive,
    ]);
});

it('throws CategoryNotFoundException when updating a non-existent category', function () {
    // Arrange
    $category       = Category::factory()->make();
    $categoryEntity = CategoryEntity::make($category->toArray());

    // Act & Assert
    expect(fn () => $this->categoryRepository->update($categoryEntity))
        ->toThrow(CategoryNotFoundException::class);
});

it('find a category and verifies it in the database', function () {
    // Arrange
    $category = Category::factory()->create();

    // Act
    /** @var CategoryEntity $categoryEntity */
    $categoryEntity = $this->categoryRepository->find($category->id);

    // Assert
    expect($categoryEntity)->toBeInstanceOf(CategoryEntity::class);
    assertDatabaseCount('categories', 1);
    assertDatabaseHas('categories', [
        'id'          => $category->id,
        'name'        => $categoryEntity->name,
        'description' => $categoryEntity->description,
        'is_active'   => $categoryEntity->isActive,
    ]);
});

it('throws CategoryNotFoundException when category is not found by UUID', function () {
    // Act & Assert
    expect(fn () => $this->categoryRepository->find((string) str()->uuid()))->toThrow(CategoryNotFoundException::class);
});

it('delete a category and verifies it in the database', function () {
    // Arrange
    $category = Category::factory()->create();

    // Act
    $categoryEntity = $this->categoryRepository->delete($category->id);

    // Assert
    expect($categoryEntity)->toBeTrue();
    assertDatabaseCount('categories', 1);
    assertSoftDeleted($category);
});

it('throws CategoryNotFoundException when deleting a non-existent category by UUID', function () {
    // Arrange
    expect(fn () => $this->categoryRepository->delete((string) str()->uuid()))->toThrow(CategoryNotFoundException::class);
});
