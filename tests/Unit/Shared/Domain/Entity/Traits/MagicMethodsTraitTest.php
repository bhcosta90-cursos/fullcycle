<?php

declare(strict_types = 1);

use Package\Shared\Domain\ValueObject\Id;
use Tests\Unit\Shared\Domain\Entity\Traits\Stub\MagicMethods;

it('generates a random id if not set', function () {
    $entity = new MagicMethods();
    expect($entity->id)->toBeInstanceOf(Id::class);
});

it('returns the correct id if set', function () {
    $id     = Id::random();
    $entity = MagicMethods::make(id: $id);
    expect($entity->id)->toBe($id);
});

it('generates a createdAt date if not set', function () {
    $entity = new MagicMethods();
    expect($entity->createdAt)->toBeInstanceOf(DateTimeInterface::class);
});

it('returns the correct createdAt date if set', function () {
    $date   = new DateTime('2020-01-01 00:00:00');
    $entity = MagicMethods::make(created_at: $date);
    expect($entity->createdAt)->toBe($date);
});

it('throws an exception for non-existent properties', function () {
    $entity = new MagicMethods();
    $entity->nonExistentProperty;
})->throws(Exception::class, 'Property nonExistentProperty not found in class ' . MagicMethods::class);

it('returns the id as a string', function () {
    $id     = Id::random();
    $entity = MagicMethods::make(id: $id);
    expect($entity->id())->toBe((string) $id);
});

it('returns the createdAt date as a string', function () {
    new DateTime('2020-01-01 00:00:00');
    $entity = MagicMethods::make(created_at: '2020-01-01 00:00:00');
    expect($entity->createdAt())->toBe('2020-01-01 00:00:00');
});
