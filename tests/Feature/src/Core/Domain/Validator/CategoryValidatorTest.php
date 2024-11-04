<?php

declare(strict_types = 1);

use Package\Core\Domain\Entity\CategoryEntity;

it('throws an exception for invalid fields', function () {
    $data = [
        [
            'name' => 'de',
        ],
        [
            'name' => str_repeat('a', 101),
        ],
        [
            'description' => str_repeat('a', 256),
        ],
    ];

    // Act & Assert
    validationException(CategoryEntity::class, $data, ['name' => 'test']);
});
