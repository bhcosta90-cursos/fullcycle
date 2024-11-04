<?php

declare(strict_types = 1);

use App\Models\User;

it('returns the fillable attributes of the User model', function () {
    $user = new User();

    $response = $user->getFillable();

    expect($response)->toBe([
        'name',
        'email',
        'password',
    ]);
});

it('returns the hidden attributes of the User model', function () {
    $user = new User();

    $response = $user->getHidden();

    expect($response)->toBe([
        'password',
        'remember_token',
    ]);
});

it('returns the casts attributes of the User model', function () {
    $user = new User();

    $response = $user->getCasts();

    expect($response)->toBe([
        'id'                => 'int',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ]);
});
