<?php

declare(strict_types = 1);

use App\Models\Category;
use Package\Application\Query\Category\PaginationCategoryQuery;
use Package\Shared\Domain\Repository\DTO\OrderInput;
use Package\Shared\Domain\Repository\Enum\Order;

it('returns zero total items when no categories are present', function () {
    // Act
    $response = (new PaginationCategoryQuery())->handle([]);

    // Assert
    expect($response)->total()->toBe(0);
});

it('returns total items and paginated items count when categories are present', function () {
    // Arrange
    Category::factory(20)->create();

    // Act
    $response = (new PaginationCategoryQuery())->handle([], totalItens: 15);

    // Assert
    expect($response)->total()->toBe(20)
        ->items()->toHaveCount(15);
});

it('returns total items and filtered items count when categories match the filter', function () {
    // Arrange
    Category::factory(5)->create();
    Category::factory(5)
        ->sequence(...collect(range(1, 5))
            ->map(fn ($i) => ['name' => "Category {$i} with filter"])->toArray())
        ->create();

    // Act
    $response = (new PaginationCategoryQuery())->handle(['name' => 'Category 1']);

    // Assert
    expect($response)->total()->toBe(1)
        ->items()->toHaveCount(1);
});

it('returns items in the correct order and handles descending order', function () {
    // Arrange
    Category::factory(2)->sequence(['name' => 'b'], ['name' => 'a'])->create();

    // Act
    $response = (new PaginationCategoryQuery())->handle([]);

    // Assert
    expect($response->items()[0])->name->toBe('a');

    // Act
    $response = (new PaginationCategoryQuery())->handle([], new OrderInput('name', Order::DESC));

    // Assert
    expect($response->items()[0])->name->toBe('b');
});
