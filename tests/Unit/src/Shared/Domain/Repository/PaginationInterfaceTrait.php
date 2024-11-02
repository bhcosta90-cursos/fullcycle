<?php

declare(strict_types = 1);

namespace Tests\Unit\src\Shared\Domain\Repository;

use Package\Shared\Domain\Repository\PaginationInterface;

trait PaginationInterfaceTrait
{
    public function mockPagination(array $items = []): PaginationInterface
    {
        $pagination = \Mockery::mock(\stdClass::class, PaginationInterface::class);
        $pagination->shouldReceive('items')->andReturn($items);
        $pagination->shouldReceive('total')->andReturn(0);
        $pagination->shouldReceive('currentPage')->andReturn(0);
        $pagination->shouldReceive('firstPage')->andReturn(0);
        $pagination->shouldReceive('lastPage')->andReturn(0);
        $pagination->shouldReceive('perPage')->andReturn(0);
        $pagination->shouldReceive('to')->andReturn(0);
        $pagination->shouldReceive('from')->andReturn(0);

        return $pagination;
    }
}
