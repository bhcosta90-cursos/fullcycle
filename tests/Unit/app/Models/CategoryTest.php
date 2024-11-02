<?php

declare(strict_types = 1);

use App\Models\Category;

it('returns the fillable attributes of the Category model', function () {
    // Arrange
    $user = new Category();

    // Act
    $response = $user->getFillable();

    // Assert
    expect($response)->toBe([
        'name',
        'description',
        'is_active',
    ]);
});

it('returns the casts attributes of the Category model', function () {
    // Arrange
    $user = new Category();

    // Act
    $response = $user->getCasts();

    // Assert
    expect($response)->toBe([
        'is_active'  => 'boolean',
        'deleted_at' => 'datetime',
    ]);
});
