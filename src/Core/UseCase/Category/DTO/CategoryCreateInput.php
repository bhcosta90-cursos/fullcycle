<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category\DTO;

class CategoryCreateInput
{
    public function __construct(
        public string $name,
        public ?string $description,
        public bool $is_active,
    ) {
        //
    }
}
