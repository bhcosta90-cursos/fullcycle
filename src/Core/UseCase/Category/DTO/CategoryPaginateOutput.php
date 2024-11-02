<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category\DTO;

class CategoryPaginateOutput
{
    public function __construct(
        public array $items,
        public int $total,
        public int $current_page,
        public int $last_page,
        public int $first_page,
        public int $per_page,
        public int $to,
        public int $from,
    ) {
    }
}
