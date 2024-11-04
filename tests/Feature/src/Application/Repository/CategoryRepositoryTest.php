<?php

declare(strict_types = 1);

use App\Models\Category;
use Package\Application\Repository\CategoryRepository;
use Package\Core\Domain\Entity\CategoryEntity;

use Package\Core\UseCase\Category\Exception\CategoryNotFoundException;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas, assertSoftDeleted};

beforeEach(fn () => $this->categoryRepository = new CategoryRepository(new Category()));

it('creates a category and verifies it in the database', function () {
    $data = new CategoryEntity(name: 'testing', description: 'testing', isActive: false);

    $result = $this->categoryRepository->create($data);

    expect($result)->toBeInstanceOf(CategoryEntity::class);
    assertDatabaseCount('categories', 1);
});

it('updated a category and verifies it in the database', function () {
    $category       = Category::factory()->create();
    $categoryEntity = CategoryEntity::make($category->toArray());

    $result = $this->categoryRepository->update($categoryEntity);

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
    $category       = Category::factory()->make();
    $categoryEntity = CategoryEntity::make($category->toArray());

    // Act & Assert
    expect(fn () => $this->categoryRepository->update($categoryEntity))
        ->toThrow(CategoryNotFoundException::class);
});

it('find a category and verifies it in the database', function () {
    $category = Category::factory()->create();

    /** @var CategoryEntity $categoryEntity */
    $categoryEntity = $this->categoryRepository->find($category->id);

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
    $category = Category::factory()->create();

    $categoryEntity = $this->categoryRepository->delete($category->id);

    expect($categoryEntity)->toBeTrue();
    assertDatabaseCount('categories', 1);
    assertSoftDeleted($category);
});

it('throws CategoryNotFoundException when deleting a non-existent category by UUID', function () {
    expect(fn () => $this->categoryRepository->delete((string) str()->uuid()))->toThrow(CategoryNotFoundException::class);
});
