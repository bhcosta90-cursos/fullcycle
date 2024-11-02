<?php

declare(strict_types = 1);

use Package\Shared\Domain\ValueObject\Id;
use Tests\Unit\Shared\Domain\Entity\Stub\Entity;
use Tests\Unit\Shared\Domain\Entity\Stub\{EntityFillable};

it('creates an entity with the correct id', function () {
    $id     = Id::random();
    $entity = Entity::make(['id' => $id]);
    expect($entity->id)->toBe($id);
});

it('creates an entity with the correct createdAt date', function () {
    $date   = new DateTime('2020-01-01 00:00:00');
    $entity = Entity::make(['created_at' => $date]);
    expect($entity->createdAt)->toBe($date);
});

it('transforms snake_case to camelCase', function () {
    $entity = Entity::make(['name' => 'Test', 'description' => 'Description']);
    expect($entity->name)->toBe('Test');
});

it('throws an exception for non-existent properties', function () {
    $entity = Entity::make(['non_existent_property' => 'value']);
    expect($entity->id)->now->toBeNull();
});

it('returns the id as a string', function () {
    $id     = Id::random();
    $entity = Entity::make(['id' => $id]);
    expect($entity->id())->toBe((string) $id);
});

it('returns the createdAt date as a string', function () {
    $date   = '2020-01-01 00:00:00';
    $entity = Entity::make(['created_at' => $date]);
    expect($entity->createdAt())->toBe($date);
});

it('transforms is_active to isActive and sets it to false', function () {
    $entity = Entity::make(['is_active' => false]);
    expect($entity->isActive)->toBeFalse();
});

it('does not update non-fillable properties', function () {
    $entity = Entity::make();
    $entity->update(name: 'testing');
    expect($entity->name)->toBe(null);
});

it('updates fillable properties', function () {
    $entity = EntityFillable::make();
    $entity->update(name: 'testing');
    expect($entity->name)->toBe('testing');

    $entity->update(['description' => 'description']);
    expect($entity)
        ->name->toBe('testing')
        ->description->toBe('description');
});
