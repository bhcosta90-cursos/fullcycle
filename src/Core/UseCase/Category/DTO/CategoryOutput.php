<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category\DTO;

class CategoryOutput
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $description,
        public bool $is_active,
        public string $created_at,
    ) {
        //
    }
}