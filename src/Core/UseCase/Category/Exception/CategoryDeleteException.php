<?php

declare(strict_types = 1);

namespace Package\Core\UseCase\Category\Exception;

use Package\Shared\Domain\Exception\{EntityDeleteException};
use Throwable;

class CategoryDeleteException extends EntityDeleteException
{
    public function __construct(string $id, int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct('category', $id, $code, $previous);
    }
}
