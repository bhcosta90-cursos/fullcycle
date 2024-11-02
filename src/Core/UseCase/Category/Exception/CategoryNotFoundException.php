<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category\Exception;

use Package\Shared\Domain\Exception\{EntityNotFoundException};
use Throwable;

class CategoryNotFoundException extends EntityNotFoundException
{
    public function __construct(string $id, int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct('category', $id, $code, $previous);
    }
}
