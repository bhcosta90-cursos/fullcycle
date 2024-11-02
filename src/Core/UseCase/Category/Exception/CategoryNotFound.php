<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category\Exception;

use Package\Shared\Domain\Exception\{EntityNotFound};

class CategoryNotFound extends EntityNotFound
{
    public function __construct(string $id, int $code = 404, ?\Throwable $previous = null)
    {
        parent::__construct('category', $id, $code, $previous);
    }
}
