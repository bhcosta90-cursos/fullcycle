<?php

declare(strict_types = 1);

use App\Models\Category;
use Package\Application\Query\Category\PaginationCategoryQuery;
use Package\Shared\Domain\Repository\DTO\OrderInput;
use Package\Shared\Domain\Repository\Enum\Order;

beforeEach(function () {
    $this->category = new Category();
    $this->useCase  = new PaginationCategoryQuery($this->category);
});

it('returns zero total items when no categories are present', function () {
    $response = $this->useCase->handle([]);

    expect($response)
        ->total()->toBe(0)
        ->perPage()->toBe(10)
        ->firstPage()->toBe(0)
        ->lastPage()->toBe(1)
        ->currentPage()->toBe(1)
        ->items()->toHaveCount(0)
        ->to()->toBe(0)
        ->from()->toBe(0);
});

it('returns total items and paginated items count when categories are present', function () {
    Category::factory(20)->create();

    $response = $this->useCase->handle([], totalItens: 15);

    expect($response)
        ->total()->toBe(20)
        ->perPage()->toBe(15)
        ->firstPage()->toBe(1)
        ->lastPage()->toBe(2)
        ->currentPage()->toBe(1)
        ->items()->toHaveCount(15)
        ->to()->toBe(1)
        ->from()->toBe(15);
});

it('a', function () {
    Category::factory(20)->create();

    $response = $this->useCase->handle([], page: 2, totalItens: 15);

    expect($response)
        ->total()->toBe(20)
        ->perPage()->toBe(15)
        ->firstPage()->toBe(16)
        ->lastPage()->toBe(2)
        ->currentPage()->toBe(2)
        ->items()->toHaveCount(5)
        ->to()->toBe(16)
        ->from()->toBe(20);
});

it('returns total items and filtered items count when categories match the filter', function () {
    Category::factory(5)->create();
    Category::factory(5)
        ->sequence(...collect(range(1, 5))
            ->map(fn ($i) => ['name' => "Category {$i} with filter"])->toArray())
        ->create();

    $response = $this->useCase->handle(['name' => 'Category 1']);

    expect($response)->total()->toBe(1)
        ->items()->toHaveCount(1);
});

it('returns items in the correct order and handles descending order', function () {
    Category::factory(2)->sequence(['name' => 'b'], ['name' => 'a'])->create();

    $response = $this->useCase->handle([]);

    expect($response->items()[0])->name->toBe('a');

    $response = $this->useCase->handle([], new OrderInput('name', Order::DESC));

    expect($response->items()[0])->name->toBe('b');
});
