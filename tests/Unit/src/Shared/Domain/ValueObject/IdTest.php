<?php

declare(strict_types = 1);

use Package\Shared\Domain\ValueObject\Id;
use Ramsey\Uuid\Uuid as RamseyUuid;

it('can be instantiated with a valid UUID', function () {
    $uuid = RamseyUuid::uuid4()->toString();
    $id   = new Id($uuid);
    expect((string) $id)->toBe($uuid);
});

it('throws an exception for an invalid UUID', function () {
    new Id('invalid-uuid');
})->throws(InvalidArgumentException::class);

it('can generate a random UUID', function () {
    $id = Id::random();
    expect(RamseyUuid::isValid((string) $id))->toBeTrue();
});
