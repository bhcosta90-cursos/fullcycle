<?php

declare(strict_types = 1);

use App\Models\User;

it('returns the fillable attributes of the User model', function () {
    // Arrange
    $user = new User();

    // Act
    $response = $user->getFillable();

    // Assert
    expect($response)->toBe([
        'name',
        'email',
        'password',
    ]);
});

it('returns the hidden attributes of the User model', function () {
    // Arrange
    $user = new User();

    // Act
    $response = $user->getHidden();

    // Assert
    expect($response)->toBe([
        'password',
        'remember_token',
    ]);
});

it('returns the casts attributes of the User model', function () {
    // Arrange
    $user = new User();

    // Act
    $response = $user->getCasts();

    // Assert
    expect($response)->toBe([
        'id'                => 'int',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ]);
});
