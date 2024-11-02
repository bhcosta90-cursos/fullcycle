<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category\DTO;

class CreateCategoryInput
{
    public function __construct(
        public string $name,
        public ?string $description,
    ) {
        //
    }
}
