<?php

declare(strict_types = 1);

use Package\Shared\Domain\Exception\EntityValidationException;
use Package\Shared\Domain\Validation\DomainValidation;

it('throws an exception if value is null or empty in notNull', function () {
    expect(fn () => DomainValidation::notNull(''))->toThrow(EntityValidationException::class, 'Should not be empty or null');
});

it('does not throw an exception if value is not null or empty in notNull', function () {
    expect(fn () => DomainValidation::notNull('value'))->not->toThrow(EntityValidationException::class);
});

it('throws an exception if value exceeds max length in strMaxLength', function () {
    $longString = str_repeat('a', 255);
    expect(fn () => DomainValidation::strMaxLength($longString))->toThrow(EntityValidationException::class, 'The value must not be greater than 255 characters');
});

it('does not throw an exception if value is within max length in strMaxLength', function () {
    $validString = str_repeat('a', 254);
    expect(fn () => DomainValidation::strMaxLength($validString))->not->toThrow(EntityValidationException::class);
});

it('throws an exception if value is shorter than min length in strMinLength', function () {
    $shortString = 'ab';
    expect(fn () => DomainValidation::strMinLength($shortString))->toThrow(EntityValidationException::class, 'The value must be at least 3 characters');
});

it('does not throw an exception if value meets min length in strMinLength', function () {
    $validString = 'abc';
    expect(fn () => DomainValidation::strMinLength($validString))->not->toThrow(EntityValidationException::class);
});

it('throws an exception if value exceeds max length in strCanNullAndMaxLength', function () {
    $longString = str_repeat('a', 256);
    expect(fn () => DomainValidation::strCanNullAndMaxLength($longString))->toThrow(EntityValidationException::class, 'The value must not be greater than 255 characters');
});

it('does not throw an exception if value is null or within max length in strCanNullAndMaxLength', function () {
    $validString = str_repeat('a', 255);
    expect(fn () => DomainValidation::strCanNullAndMaxLength($validString))->not->toThrow(EntityValidationException::class)
        ->and(fn () => DomainValidation::strCanNullAndMaxLength(''))->not->toThrow(EntityValidationException::class);
});
