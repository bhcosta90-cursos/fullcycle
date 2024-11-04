<?php

declare(strict_types = 1);

use App\Models\Category;

it('returns the fillable attributes of the Category model', function () {
    $user = new Category();

    $response = $user->getFillable();

    expect($response)->toBe([
        'name',
        'description',
        'is_active',
    ]);
});

it('returns the casts attributes of the Category model', function () {
    $user = new Category();

    $response = $user->getCasts();

    expect($response)->toBe([
        'is_active'  => 'boolean',
        'deleted_at' => 'datetime',
    ]);
});
