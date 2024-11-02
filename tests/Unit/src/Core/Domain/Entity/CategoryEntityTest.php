<?php

declare(strict_types = 1);

use Package\Core\Domain\Entity\CategoryEntity;
use Package\Shared\Domain\Entity\Entity;
use Package\Shared\Domain\Validation\ValidatorInterface;
use Package\Shared\Domain\ValueObject\Id;

beforeEach(function () {
    $mock = Mockery::mock(ValidatorInterface::class);
    $mock->shouldReceive('validate')->andReturn([]);
    Entity::setValidatorFactory(fn () => $mock);
});

it('can create a entity with default values', function () {

    // Arrange
    $category = new CategoryEntity(name: 'category');

    // Act & Assert
    expect($category)
        ->toBeInstanceOf(CategoryEntity::class)
        ->name->toBe('category')
        ->description->toBeNull()
        ->isActive->toBeTrue()
        ->id->not->toBeNull()
        ->createdAt->not->toBeNull()
        ->id()->not->toBeNull()
        ->createdAt()->not->toBeNull();
});

it('can create a entity with all values', function () {
    // Arrange
    $category = CategoryEntity::make(
        name: 'category',
        description: 'description',
        id: '61a568f4-d025-478d-bc95-f812cc0021a3',
        created_at: '2020-01-01 00:00:00',
        is_active: false,
    );

    // Act & Assert
    expect($category)
        ->toBeInstanceOf(CategoryEntity::class)
        ->name->toBe('category')
        ->description->toBe('description')
        ->isActive->toBeFalse()
        ->id->not->toBe(new Id('61a568f4-d025-478d-bc95-f812cc0021a3'))
        ->createdAt->format('Y-m-d H:i:s')->toBe('2020-01-01 00:00:00')
        ->id()->toBe('61a568f4-d025-478d-bc95-f812cc0021a3')
        ->createdAt()->toBe('2020-01-01 00:00:00');
});

it('update fields of entity', function () {
    $category = new CategoryEntity(name: 'category');
    $category->update(name: 'new category', description: 'new description', is_active: false);

    expect($category)
        ->name->toBe('new category')
        ->description->toBe('new description')
        ->isActive->toBeTrue();
});

it('can disable the entity', function () {
    // Arrange
    $category = new CategoryEntity(name: 'category');

    // Act
    $category->disable();

    // Assert
    expect($category->isActive)->toBeFalse();
});

it('can enable the entity', function () {
    // Arrange
    $category = new CategoryEntity(name: 'category', isActive: false);

    // Act
    $category->enable();

    // Assert
    expect($category->isActive)->toBeTrue();
});
